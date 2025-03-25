<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\Payment\MomoController;
use App\Http\Controllers\Client\Payment\VNPayController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Variant;
use App\Models\Voucher;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        // dd($request->all());
        $cart = Cart::where('user_id', Auth::id())->first();
        // dd($cart->id);
        $cart_detail = CartDetail::where('cart_id', $cart->id)
            ->where('is_selected', CartDetail::SELECTED)
            ->get();


        try {
            if ($cart_detail->isEmpty())
                return response()->json(['error' => 'Giỏ hàng trống'], 400);
            switch ($request->payment_method) {
                case "VNPAY_DECOD":
                    // dd($request->all());
                    $order = $this->createOrder($request, 'Chờ thanh toán');


                    $this->orderItems($cart_detail, $order->id);

                    $this->vnpay_service->VNpay_Payment($order->total_price, 'vn', $request->ip(), $order->id);
                    break;
                case "MOMO":
                    // dd(1);
                    break;
                case "COD":
                    // dd($cart_detail);
                    try {
                        $order = $this->createOrder($request, 'Thanh toán khi nhận hàng');
                        // dd($order);
                        $orderdatail = $this->orderItems($cart_detail, $order->id);
                        // dd($orderdatail);
                        if (!$orderdatail) {
                            return response()->json(['status' => 'error', 'message' => 'Lỗi khi thêm chi tiết đơn hàng!'], 500);
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    return view('client.checkout.complete');
                    break;
                default:
                    return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán không hợp lệ!'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e]);
        }
    }
    private function createOrder($request, $status)
    {
        try {

            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = Order::PENDING;
            $order->total_price = $request->total_price;
            $order->address_id = $request->address_id;
            $order->payment_method = $request->payment_method;
            $order->payment_status = $status;
            $order->order_date = now();
            $order->voucher_id = $request->voucher_id ?? null;
            if ($order->save()) {

                return $order;
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            return null;
        }
    }

    private function orderItems($items, $orderId)
    {
        try {
            foreach ($items as $item) {

                $price = Product::where('id', $item->product_id)->value('price_sale')
                    ?? Product::where('id', $item->product_id)->value('base_price')
                    ?? 0;

                $order = new OrderDetail();
                $order->order_id = $orderId;
                $order->product_id = $item->product_id ?? null;
                $order->variant_id = $item->variant_id ?? null;
                $order->quantity = $item->quantity;
                $order->price = $price;
                $order->total_price = $item->total_amount;
                $order->product_name = $item->product->name ?? $item->variant->product->name;
                $order->save();
                // Trừ số lượng tồn kho
                if ($item->variant_id) {
                    $variant = Variant::find($item->variant_id);
                    if ($variant) {
                        $variant->quantity -= $item->quantity;
                        $variant->save();
                    }
                } else {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->quantity -= $item->quantity;
                        $product->save();
                    }
                }
                // Xóa sản phẩm khỏi giỏ hàng
                CartDetail::find($item->id)->delete();

                // Kiểm tra nếu giỏ hàng không còn sản phẩm nào thì xóa luôn
                $remainingItems = CartDetail::where('cart_id', $item->cart_id)->count();
                if ($remainingItems === 0) {
                    Cart::where('id', $item->cart_id)->delete();
                }
            }
            // Trạng Thái đơn hàng
            try {
                Shipping::create([
                    'order_id' => $orderId,
                    'name' => 'Đơn hàng của bạn đã được đặt thành công',
                    'note' => 'Đơn hàng đang đợi được xác nhận',
                ]);
            } catch (\Exception $e) {
                Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            }
            return back()->with('success', 'Bạn đã đặt hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());
        }
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
