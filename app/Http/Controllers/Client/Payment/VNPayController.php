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

    public function handleReturn(Request $request)
    {
        try {
            // Log toàn bộ dữ liệu từ VNPAY để debug
            Log::info('VNPAY Response:', $request->all());

            if (!$request->has('vnp_TxnRef') || !$request->has('vnp_ResponseCode')) {
                Log::error('Thiếu tham số từ VNPAY');
                return view('client.checkout.failed');
            }

            $orderId = $request->vnp_TxnRef;
            $responseCode = $request->vnp_ResponseCode;
            $transactionNo = $request->vnp_TransactionNo;
            $bankCode = $request->vnp_BankCode;

            Log::info('Xử lý thanh toán VNPAY:', [
                'orderId' => $orderId,
                'responseCode' => $responseCode,
                'transactionNo' => $transactionNo,
                'bankCode' => $bankCode
            ]);

            $order = Order::with(['orderDetails', 'orderDetails.product', 'orderDetails.variant', 'address', 'user'])->find($orderId);
            if (!$order) {
                Log::error('Không tìm thấy đơn hàng: ' . $orderId);
                return view('client.checkout.failed');
            }

            // Kiểm tra mã phản hồi từ VNPAY
            if ($responseCode === '00') {
                DB::beginTransaction();
                try {
                    // Cập nhật trạng thái đơn hàng
                    $order->status = 'confirmed';
                    $order->payment_status = 'Thanh toán thành công';
                    $order->save();

                    // Tạo trạng thái vận chuyển
                    Shipping::create([
                        'order_id' => $order->id,
                        'name' => 'Chờ xử lý',
                        'note' => 'Đơn hàng đã được thanh toán qua VNPAY'
                    ]);

                    // Gửi email hóa đơn
                    try {
                        Mail::to($order->user->email)->send(new OrderInvoice($order, $order->orderDetails));
                    } catch (\Exception $e) {
                        Log::error('Lỗi gửi email hóa đơn: ' . $e->getMessage());
                    }

                    // Xóa sản phẩm khỏi giỏ hàng
                    $cart = Cart::where('user_id', $order->user_id)->first();
                    if ($cart) {
                        CartDetail::where('cart_id', $cart->id)
                            ->where('is_selected', true)
                            ->delete();

                        // Kiểm tra và xóa giỏ hàng nếu không còn sản phẩm
                        if (CartDetail::where('cart_id', $cart->id)->count() === 0) {
                            $cart->delete();
                        }
                    }

                    DB::commit();
                    Log::info('Xử lý thanh toán thành công cho đơn hàng: ' . $orderId);
                    return view('client.checkout.complete');

                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Lỗi xử lý thanh toán thành công: ' . $e->getMessage());
                    Log::error('Stack trace: ' . $e->getTraceAsString());
                    return view('client.checkout.failed');
                }
            } else {
                Log::error('Thanh toán thất bại với mã lỗi: ' . $responseCode);
                return view('client.checkout.failed');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi không mong đợi: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return view('client.checkout.failed');
        }
    }
}