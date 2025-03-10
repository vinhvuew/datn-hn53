<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\Payment\MomoController;
use App\Http\Controllers\Client\Payment\VNPayController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;

use App\Models\OrderDetail;
use App\Models\Voucher;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $vnpay_service;
    protected $momo_service;
    public function __construct(VNPayController $vnpay_servie, MomoController $momo_service)
    {
        $this->vnpay_service = $vnpay_servie;
        $this->momo_service = $momo_service;
    }
    public function placeOrder(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart_detail = CartDetail::where('cart_id', $cart->id)->get();
        // return response()->json($cart_detail);

        try {
            if ($cart_detail == null)
                return response()->json(['error' => 'Giỏ hàng trống']);
            switch ($request->payment_method) {
                case "VNPAY_DECOD":
                    $order = $this->createOrder($request, 'Chờ thanh toán');
                    $this->orderItems($cart_detail, $order->id, $cart->id);

                    $this->vnpay_service->VNpay_Payment($order->total_price, 'vn', $request->ip(), $order->id);

                    break;
                case "MOMO":

                    dd(1);
                    break;
                case "COD":
                    // dd($cart_detail);
                    $order = $this->createOrder($request, 'Thanh toán khi nhận hàng');
                    // dd($order);
                    $this->orderItems($cart_detail, $order->id, $cart->id);
                    return view('client.checkout.complete');
                    break;
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage()]);
        }
    }
    private function createOrder($request, $status)
    {
        return Order::create([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'total_price' => $request->total_price,
            'address_id' => $request->address_id,
            'payment_method' => $request->payment_method,
            'payment_status' => $status,
            'order_date' => now(),
            'voucher_id' => $request->voucher_id ? $request->voucher_id : null,
        ]);
    }
    private function orderItems($items, $orderId, $cart_id)
    {
        foreach ($items as $item) {
            // dd($item);
            OrderDetail::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id ?? null,
                'variant_id' => $item->variant_id ?? null,
                'quantity' => $item->quantity,
                'price' => $item->variant->product->base_price,
                'total_price' => $item->total_amount,
            ]);
        }

        CartDetail::where('cart_id', $cart_id)->delete();
    }


    public function applyVoucher(Request $request)
    {
        $voucher = Voucher::where('code', $request->coupon_code)->first();

        if (!$voucher) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        }


        if ($voucher->status !== 'active' || ($voucher->end_date && $voucher->end_date < now())) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá đã hết hạn!']);
        }

        $totalAmount = $request->total_amount;

        if ($voucher->min_order_value && $totalAmount < $voucher->min_order_value) {
            return response()->json(['status' => 'error', 'message' => 'Giá trị đơn hàng chưa đủ để áp dụng mã giảm giá!']);
        }

        $discountAmount = 0;

        if ($voucher->discount_type === 'percentage') {
            $discountAmount = ($totalAmount * $voucher->discount_value) / 100;
        } else {
            $discountAmount = $voucher->discount_value;
        }

        if ($voucher->max_discount_value && $discountAmount > $voucher->max_discount_value) {
            $discountAmount = $voucher->max_discount_value;
        }

        $finalTotal = $totalAmount - $discountAmount;

        return response()->json([
            'status' => 'success',
            'message' => 'Áp dụng mã giảm giá thành công!',
            'discount_amount' => $discountAmount,
            'final_total' => $finalTotal,
            'voucher_id' => $voucher->id
        ]);
    }
}
