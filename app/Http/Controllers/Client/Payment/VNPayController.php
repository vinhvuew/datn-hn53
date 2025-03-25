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

class VNPayController extends Controller
{
    public function VNpay_Payment($amount, $language, $vnp_IpAddr, $vnp_TxnRef)
    {
        $vnp_TmnCode = env('VNP_TMNCODE'); 
        $vnp_HashSecret = env('VNP_HASHSECRET'); 
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        
        $vnp_Locale = $language;
        $vnp_BankCode = 'VNBANK';


        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'), 
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" =>  $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    public function handleReturn()
    {
        try {
            if (!isset($_GET['vnp_TxnRef']) || !isset($_GET['vnp_ResponseCode'])) {
                Log::error('VNPAY return: Missing required parameters');
                return view('client.checkout.failed');
            }

            $orderId = $_GET['vnp_TxnRef'];
            $responseCode = $_GET['vnp_ResponseCode'];

            $order = Order::with('orderDetails')->find($orderId);
            if (!$order) {
                Log::error('VNPAY return: Order not found', ['order_id' => $orderId]);
                return view('client.checkout.failed');
            }

            if ($responseCode == '00') {
                DB::beginTransaction();
                try {
                    $order->payment_status = "Thanh toán thành công";
                    $order->status = "confirmed";
                    
                    if ($order->save()) {
                        // Tạo shipping status
                        Shipping::create([
                            'order_id' => $order->id,
                            'name' => 'Đơn hàng đã được thanh toán',
                            'note' => 'Thanh toán thành công qua VNPAY'
                        ]);

                        // Xóa sản phẩm khỏi giỏ hàng
                        $cart = Cart::where('user_id', $order->user_id)->first();
                        if ($cart) {
                            CartDetail::where('cart_id', $cart->id)
                                ->where('is_selected', CartDetail::SELECTED)
                                ->delete();

                            // Kiểm tra và xóa giỏ hàng nếu không còn sản phẩm
                            if (CartDetail::where('cart_id', $cart->id)->count() === 0) {
                                $cart->delete();
                            }
                        }
                        
                        DB::commit();
                        return view('client.checkout.complete');
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error('VNPAY return: Error processing successful payment', [
                        'order_id' => $orderId,
                        'error' => $e->getMessage()
                    ]);
                    return view('client.checkout.failed');
                }
            }

            return view('client.checkout.failed');
        } catch (\Exception $e) {
            Log::error('VNPAY return: Unexpected error', ['error' => $e->getMessage()]);
            return view('client.checkout.failed');
        }
    }
}
