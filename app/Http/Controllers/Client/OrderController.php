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
    public function __construct(VNPayController $vnpay_servie, MomoController $momo_service)
    {
        $this->vnpay_service = $vnpay_servie;
        $this->momo_service = $momo_service;
    }
    public function placeOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart_detail = CartDetail::whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

            if ($cart_detail->isEmpty()) {
                return response()->json(['status' => 'error', 'message' => 'Giỏ hàng trống!'], 400);
            }

            $order = $this->createOrder($request, $request->payment_method === 'COD' ? 'Thanh toán khi nhận hàng' : 'Chờ thanh toán');
            if (!$order) {
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Lỗi khi tạo đơn hàng!'], 500);
            }

            $orderItemsResult = $this->orderItems($cart_detail, $order->id);
            if (!$orderItemsResult) {
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Lỗi khi thêm chi tiết đơn hàng!'], 500);
            }

            // Cập nhật trạng thái voucher nếu có
            if ($order->voucher_id) {
                $voucher = Voucher::find($order->voucher_id);
                if ($voucher) {
                    // Kiểm tra số lượng voucher
                    if ($voucher->quantity !== null) {
                        if ($voucher->quantity <= 0) {
                            DB::rollback();
                            return response()->json(['status' => 'error', 'message' => 'Voucher đã hết!'], 400);
                        }
                        $voucher->quantity -= 1;
                        $voucher->save();
                    }
                }
            }

            switch ($request->payment_method) {
                case "VNPAY_DECOD":
                    DB::commit();
                    return $this->vnpay_service->VNpay_Payment($order->id, $order->total_price);

                case "MOMO":
                    DB::rollback();
                    return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán MOMO chưa được hỗ trợ!'], 400);

                case "COD":
                    // Gửi email xác nhận đơn hàng
                    $order = Order::with(['orderDetails', 'orderDetails.product', 'orderDetails.variant', 'address', 'user'])->find($order->id);
                    try {
                        Mail::to($order->user->email)->send(new OrderInvoice($order, $order->orderDetails));
                    } catch (\Exception $e) {
                        Log::error('Lỗi gửi email hóa đơn COD: ' . $e->getMessage());
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
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage()], 500);
        }
    }
    private function createOrder($request, $status)
    {
        // dd($request->all());
        try {

            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = Order::PENDING;
            $order->total_price = $request->total_price;
            $order->address_id = $request->address_id;
            $order->payment_method = $request->payment_method;
            $order->payment_status = $status;
            $order->order_date = now();
            if ($request->voucher_id) {
                $voucher = Voucher::find($request->voucher_id);
                if ($voucher) {
                    $order->voucher_id = $voucher->id;
                   
                    $order->voucher_code = $voucher->code;
                    $order->voucher_name = $voucher->name;
                    $order->voucher_discount_type = $voucher->discount_type;
                    $order->voucher_discount_value = $voucher->discount_value;
                    
                    $discountAmount = 0;
                    if ($voucher->discount_type === 'percentage') {
                        $discountAmount = ($request->total_price * $voucher->discount_value) / 100;
                    } else {
                        $discountAmount = $voucher->discount_value;
                    }
                    if ($voucher->max_discount_value && $discountAmount > $voucher->max_discount_value) {
                        $discountAmount = $voucher->max_discount_value;
                    }
                    
                    $order->voucher_discount_amount = $discountAmount;
                }
            }

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
                // Kiểm tra xem có đủ thông tin về sản phẩm hoặc biến thể không
                if (!$item->product_id && !$item->variant_id) {
                    Log::error('Không có product_id hoặc variant_id trong item.');
                    continue; // Skip this item
                }

                // Tính giá sản phẩm (giảm giá hoặc giá gốc)
                // $price = Product::where('id', $item->product_id)->value('price_sale')
                //     ?? Product::where('id', $item->product_id)->value('base_price')
                //     ?? 0;
                // Tạo chi tiết đơn hàng (OrderDetail)
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
                // Kiểm tra nếu có biến thể và các thuộc tính
                if ($item->variant && $item->variant->attributes && $item->variant->attributes->isNotEmpty()) {
                    // Duyệt qua các thuộc tính và lấy tên và giá trị
                    $variantAttributes = $item->variant->attributes;

                    $attributeNames = $variantAttributes->map(function ($attribute) {
                        return $attribute->attribute->name;  // Lấy tên thuộc tính (ví dụ: "Size", "Color")
                    });

                    $attributeValues = $variantAttributes->map(function ($attribute) {
                        return $attribute->attributeValue->value;  // Lấy giá trị thuộc tính (ví dụ: "42", "Red")
                    });

                    // Lưu tên thuộc tính và giá trị vào các trường tách biệt
                    $order->variant_attribute = $attributeNames->implode(' - ');  // Lưu tên thuộc tính (Ví dụ: "Size - Color")
                    $order->variant_value = $attributeValues->implode(' - ');  // Lưu giá trị thuộc tính (Ví dụ: "42 - Red")
                } else {
                    $order->variant_attribute = null;
                    $order->variant_value = null;
                }
                $order->save();
                // dd($order);
                // Xử lý giảm số lượng tồn kho
                if ($item->variant_id) {
                    $variant = Variant::find($item->variant_id);
                    if ($variant) {
                        $variant->quantity -= $item->quantity;
                        if (!$variant->save()) {
                            Log::error('Không thể cập nhật tồn kho variant với ID: ' . $item->variant_id);
                        }
                    } else {
                        Log::error('Không tìm thấy variant với ID: ' . $item->variant_id);
                    }
                } else {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->quantity -= $item->quantity;
                        if (!$product->save()) {
                            Log::error('Không thể cập nhật tồn kho product với ID: ' . $item->product_id);
                        }
                    } else {
                        Log::error('Không tìm thấy product với ID: ' . $item->product_id);
                    }
                }

                // Xóa sản phẩm khỏi giỏ hàng
                $cartDetail = CartDetail::find($item->id);
                if ($cartDetail) {
                    $cartDetail->delete();
                } else {
                    Log::error('Không tìm thấy CartDetail với ID: ' . $item->id);
                }

                // Kiểm tra nếu giỏ hàng không còn sản phẩm nào thì xóa luôn
                $remainingItems = CartDetail::where('cart_id', $item->cart_id)->count();
                if ($remainingItems === 0) {
                    $cart = Cart::find($item->cart_id);
                    if ($cart) {
                        $cart->delete();
                    } else {
                        Log::error('Không tìm thấy giỏ hàng với ID: ' . $item->cart_id);
                    }
                }
            }


            // Thêm thông tin giao hàng
            try {
                Shipping::create([
                    'order_id' => $orderId,
                    'name' => 'Đơn hàng của bạn đã được đặt thành công',
                    'note' => 'Đơn hàng đang đợi được xác nhận',
                ]);
            } catch (\Exception $e) {
                Log::error('Lỗi khi tạo Shipping: ' . $e->getMessage());
            }

            // Trả về thông báo thành công
            return back()->with('success', 'Bạn đã đặt hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào đơn hàng.');
        }
    }

    public function applyVoucher(Request $request)
    {
        $voucher = Voucher::where('code', $request->coupon_code)->first();

        if (!$voucher) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        }

        // Kiểm tra xem voucher đã được sử dụng bởi người dùng này chưa
        if ($voucher->hasBeenUsedBy(Auth::user())) {
            return response()->json(['status' => 'error', 'message' => 'Bạn đã sử dụng mã giảm giá này trước đó!']);
        }

        if ($voucher->status !== 'active' || ($voucher->end_date && $voucher->end_date < now())) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá đã hết hạn!']);
        }

        // Kiểm tra số lượng voucher
        if ($voucher->quantity !== null && $voucher->quantity <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá đã hết!']);
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
            'voucher_id' => $voucher->id,
            'voucher_quantity' => $voucher->quantity ? 'Còn lại: ' . $voucher->quantity . ' voucher' : 'Không giới hạn số lượng'
        ]);
    }
}
