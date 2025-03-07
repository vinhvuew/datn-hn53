<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Order_deltail;
use App\Models\Status_order;
use App\Models\Voucher;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
    dd($request->all());
        DB::beginTransaction(); 
    
        try {
            $user = auth()->user();
            $cart = Cart::where('user_id', $user->id)->first();
            $paymentMethod = $request->payment_method;
            $addressId = $request->address_id;
            $voucherId = $request->voucher_id;
    
            if (!$cart || $cart->cartDetails->isEmpty()) {
                return response()->json(['status' => 'error', 'message' => 'Giỏ hàng của bạn đang trống!']);
            }
    
            $defaultStatus = Status_order::where('name', 'pending')->first();
            if (!$defaultStatus) {
                throw new \Exception('Trạng thái đơn hàng mặc định không tồn tại!');
            }
    
            $totalAmount = $cart->cartDetails->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
    
            $discountAmount = 0;
            if ($voucherId) {
                $voucher = Voucher::find($voucherId);
                if ($voucher) {
                    $discountAmount = $voucher->discount_value;
                    $totalAmount -= $discountAmount; 
                    $totalAmount = max($totalAmount, 0); 
                }
            }
    
            $order = Order::create([
                'user_id' => $user->id,
                'status_id' => $defaultStatus->id, 
                'total_price' => $totalAmount,
                'address_id' => $addressId,
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
                'order_date' => now(),
                'voucher_id' => $voucherId,
            ]);
    
            $this->orderItems($cart->cartDetails, $order->id);
    
            CartDetail::where('cart_id', $cart->id)->delete();
    
            DB::commit();
    
            if ($paymentMethod == 'COD') {
                return response()->json(['status' => 'success', 'message' => 'Đặt hàng thành công!']);
            } elseif ($paymentMethod == 'VNPAY') {
                return $this->processVNPay($order);
            } elseif ($paymentMethod == 'MOMO') {
                return $this->processMoMo($order);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán không hợp lệ!']);
            }
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage()]);
        }
    }

    private function orderItems($items, $orderId) {
        foreach ($items as $item) {
            Order::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'total_amount' => $item->total_amount
            ]);
        }
    
        // Xóa giỏ hàng sau khi đặt hàng thành công
        CartDetail::where('cart_id', auth()->user()->cart->id)->delete();
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
        'voucher_id'=>$voucher->id
    ]);
}

}
