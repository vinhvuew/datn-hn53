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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderInvoice;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $vnpay_service;
    protected $momo_service;

    public function __construct(VNPayController $vnpay_service, MomoController $momo_service)
    {
        $this->vnpay_service = $vnpay_service;
        $this->momo_service = $momo_service;
    }

    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            // Lấy giỏ hàng của người dùng
            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                return response()->json(['error' => 'Không tìm thấy giỏ hàng'], 404);
            }

            // Lấy chi tiết giỏ hàng đã chọn
            $cart_detail = CartDetail::where('cart_id', $cart->id)
                ->where('is_selected', CartDetail::SELECTED)
                ->get();

            if ($cart_detail->isEmpty()) {
                return response()->json(['error' => 'Giỏ hàng trống'], 400);
            }

            // Tạo đơn hàng với thông tin đã tính toán giảm giá trong createOrder
            $order = $this->createOrder($request, $request->payment_method === 'COD' ? 'Thanh toán khi nhận hàng' : 'Chờ thanh toán');
            if (!$order) {
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Lỗi khi tạo đơn hàng!'], 500);
            }

            // Thêm các chi tiết đơn hàng vào order
            $orderItemsResult = $this->orderItems($cart_detail, $order->id);
            if (!$orderItemsResult) {
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Lỗi khi thêm chi tiết đơn hàng!'], 500);
            }
            // Xử lý phương thức thanh toán
            switch ($request->payment_method) {
                case "VNPAY_DECOD":
                    DB::commit();
                    return $this->vnpay_service->VNpay_Payment($order->id, $order->total_price);

                case "MOMO":
                    DB::rollback();
                    return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán MOMO chưa được hỗ trợ!'], 400);

                case "COD":
                    $order = Order::with(['orderDetails', 'orderDetails.product', 'orderDetails.variant', 'address', 'user'])->find($order->id);
                    try {
                        Mail::to($order->user->email)->send(new OrderInvoice($order, $order->orderDetails));
                    } catch (\Exception $e) {
                        Log::error('Lỗi gửi email hóa đơn COD: ' . $e->getMessage());
                    }

                    if ($order->voucher_id) {
                        $voucher = Voucher::find($order->voucher_id);
                        if ($voucher && $voucher->quantity) {
                            $voucher->quantity -= 1;
                            $voucher->save();
                        }
                    }

                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Đặt hàng thành công',
                        'order_id' => $order->id
                    ]);

                default:
                    DB::rollback();
                    return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán không hợp lệ!'], 400);
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Lỗi khi đặt hàng: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage()], 500);
        }
    }


    private function createOrder($request, $status)
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cartDetails = CartDetail::where('cart_id', $cart->id)
                ->where('is_selected', CartDetail::SELECTED)
                ->get();

            if ($cartDetails->isEmpty()) {
                return null;
            }

            $cartTotal = $cartDetails->sum('total_amount');
            $discountAmount = 0;

            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = Order::PENDING;
            $order->address_id = $request->address_id;
            $order->payment_method = $request->payment_method;
            $order->payment_status = $status;
            $order->order_date = now();

            // Áp dụng voucher nếu có
            if ($request->voucher_id) {
                $voucher = Voucher::find($request->voucher_id);
                if ($voucher) {
                    $order->voucher_id = $voucher->id;
                    $order->voucher_code = $voucher->code;
                    $order->voucher_name = $voucher->name;
                    $order->voucher_discount_type = $voucher->discount_type;
                    $order->voucher_discount_value = $voucher->discount_value;

                    if ($voucher->discount_type === 'percentage') {
                        $discountAmount = ($cartTotal * $voucher->discount_value) / 100;
                    } else {
                        $discountAmount = $voucher->discount_value;
                    }

                    if ($voucher->max_discount_value && $discountAmount > $voucher->max_discount_value) {
                        $discountAmount = $voucher->max_discount_value;
                    }

                    $order->voucher_discount_amount = $discountAmount;
                }
            }

            // Tổng tiền cuối cùng
            $finalTotal = $cartTotal - $discountAmount;
            $order->total_price = $finalTotal;

            if ($order->save()) {
                return $order;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            return null;
        }
    }

    private function orderItems($items, $orderId)
    {
        try {
            foreach ($items as $item) {
                if (!$item->product_id && !$item->variant_id) {
                    continue;
                }

                $order = new OrderDetail();
                $order->order_id = $orderId;
                $order->product_id = $item->product_id ?? null;
                $order->variant_id = $item->variant_id ?? null;
                $order->quantity = $item->quantity;
                $order->price = $item->variant->product->price_sale
                    ?? $item->variant->product->base_price
                    ?? $item->product->price_sale
                    ?? $item->product->base_price
                    ?? 0;
                $order->total_price = $item->total_amount;
                $order->product_name = $item->product->name ?? $item->variant->product->name;

                if ($item->variant && $item->variant->attributes->isNotEmpty()) {
                    $attributeNames = $item->variant->attributes->map(fn($attr) => $attr->attribute->name);
                    $attributeValues = $item->variant->attributes->map(fn($attr) => $attr->attributeValue->value);
                    $order->variant_attribute = $attributeNames->implode(' - ');
                    $order->variant_value = $attributeValues->implode(' - ');
                }

                $order->save();

                // Trừ tồn kho
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

                // Xóa item khỏi giỏ hàng
                $item->delete();

                // Xóa giỏ nếu trống
                if (CartDetail::where('cart_id', $item->cart_id)->count() === 0) {
                    Cart::find($item->cart_id)?->delete();
                }
            }

            // Thêm trạng thái giao hàng
            Shipping::create([
                'order_id' => $orderId,
                'name' => 'Đơn hàng đang đợi được xác nhận',
                'note' => '',
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());
            return false;
        }
    }
}
