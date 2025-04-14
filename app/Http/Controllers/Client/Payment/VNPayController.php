<?php

namespace App\Http\Controllers\Client\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\OrderDetail;
use App\Mail\OrderInvoice;
use Illuminate\Support\Facades\Mail;

class VNPayController extends Controller
{
    public function VNpay_Payment($orderId, $amount)
    {
        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VNBANK';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan don hang #" . $orderId,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $orderId,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function repayOrder($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            // Kiểm tra nếu đơn hàng không phải đang chờ thanh toán VNPAY
            if ($order->payment_method !== 'VNPAY_DECOD' || $order->payment_status !== 'Chờ thanh toán') {
                return back()->with('error', 'Đơn hàng không hợp lệ để thanh toán lại.');
            }

            // Gọi lại phương thức thanh toán VNPAY
            return $this->VNpay_Payment($order->id, $order->total_price);
        } catch (\Exception $e) {
            Log::error('Lỗi thanh toán lại VNPAY: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi thực hiện thanh toán lại.');
        }
    }

    public function handleReturn(Request $request)
    {
        try {

            Log::info('VNPAY Response:', $request->all());


            if (!$request->has('vnp_ResponseCode')) {
                Log::info('Người dùng hủy thanh toán VNPAY');
                return redirect()->route('profile.myOder')->with('warning', 'Bạn đã hủy thanh toán VNPAY');
            }

            $orderId = $request->vnp_TxnRef;
            $responseCode = $request->vnp_ResponseCode;
            $transactionNo = $request->vnp_TransactionNo ?? null;
            $bankCode = $request->vnp_BankCode ?? null;

            Log::info('Xử lý thanh toán VNPAY:', [
                'orderId' => $orderId,
                'responseCode' => $responseCode,
                'transactionNo' => $transactionNo,
                'bankCode' => $bankCode
            ]);


            if (!$orderId) {
                Log::error('Không có mã đơn hàng từ VNPAY');
                return redirect()->route('profile.myOder')->with('error', 'Không tìm thấy thông tin đơn hàng');
            }

            $order = Order::with(['orderDetails', 'orderDetails.product', 'orderDetails.variant', 'address', 'user'])->find($orderId);
            if (!$order) {
                Log::error('Không tìm thấy đơn hàng: ' . $orderId);
                return redirect()->route('profile.myOder')->with('error', 'Không tìm thấy đơn hàng');
            }


            if ($responseCode === '00') {
                DB::beginTransaction();
                try {

                    $order->status = 'confirmed';
                    $order->payment_status = 'Thanh toán thành công';
                    $order->save();


                    Shipping::create([
                        'order_id' => $order->id,
                        'name' => 'Đơn hàng đã được xác nhận',
                        'note' => 'Đơn hàng đã được thanh toán qua VNPAY'
                    ]);


                    try {
                        Mail::to($order->user->email)->send(new OrderInvoice($order, $order->orderDetails));
                    } catch (\Exception $e) {
                        Log::error('Lỗi gửi email hóa đơn: ' . $e->getMessage());
                    }

                    $cart = Cart::where('user_id', $order->user_id)->first();
                    if ($cart) {
                        CartDetail::where('cart_id', $cart->id)
                            ->where('is_selected', true)
                            ->delete();

                        if (CartDetail::where('cart_id', $cart->id)->count() === 0) {
                            $cart->delete();
                        }
                    }

                    DB::commit();
                    Log::info('Xử lý thanh toán thành công cho đơn hàng: ' . $orderId);
                    return redirect()->route('checkout.complete', ['order_id' => $order->id]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Lỗi xử lý thanh toán thành công: ' . $e->getMessage());
                    Log::error('Stack trace: ' . $e->getTraceAsString());
                    return redirect()->route('profile.myOder')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
                }
            } else {

                Log::warning('Thanh toán VNPAY không thành công:', [
                    'order_id' => $orderId,
                    'response_code' => $responseCode,
                    'message' => $this->getVNPayResponseMessage($responseCode)
                ]);

                return redirect()->route('profile.myOder')
                    ->with('warning', 'Thanh toán không thành công: ' . $this->getVNPayResponseMessage($responseCode));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi không mong đợi: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('profile.myOder')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    private function getVNPayResponseMessage($responseCode)
    {
        $messages = [
            '00' => 'Giao dịch thành công',
            '07' => 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).',
            '09' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.',
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.',
            '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP).',
            '24' => 'Giao dịch không thành công do: Khách hàng hủy giao dịch',
            '51' => 'Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.',
            '65' => 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.',
            '75' => 'Ngân hàng thanh toán đang bảo trì.',
            '79' => 'Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định.',
            '99' => 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)',
        ];

        return $messages[$responseCode] ?? 'Lỗi không xác định';
    }
}
