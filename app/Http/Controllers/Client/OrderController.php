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
        try {
            DB::beginTransaction();

            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                return response()->json(['error' => 'Không tìm thấy giỏ hàng'], 404);
            }

            $cart_detail = CartDetail::where('cart_id', $cart->id)
                ->where('is_selected', CartDetail::SELECTED)
                ->get();

            if ($cart_detail->isEmpty()) {
                return response()->json(['error' => 'Giỏ hàng trống'], 400);
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
            // $order->save();
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
                // $order->variant_attribute = $item->variant->attributes ?? null; // "Size - Color"
                // $order->variant_value = $item->variant->attributeValue ?? null;    // "42 - Trắng"
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

    // private function orderItems($items, $orderId)
    // {

    //     try {
    //         foreach ($items as $item) {
    //             $price = 0;

    //             $price = Product::where('id', $item->product_id)->value('price_sale')
    //                 ?? Product::where('id', $item->product_id)->value('base_price')
    //                 ?? 0;
    //             $order = new OrderDetail();
    //             $order->order_id = $orderId;
    //             $order->product_id = $item->product_id ?? null;
    //             $order->variant_id = $item->variant_id ?? null;
    //             $order->quantity = $item->quantity;
    //             $order->price = $price;
    //             $order->total_price = $item->total_amount;
    //             $order->product_name = $item->product->name ?? $item->variant->product->name;
    //             $order->save();

    //              // Trừ số lượng tồn kho
    //              if ($item->variant_id) {
    //                 $variant = Variant::find($item->variant_id);
    //                 if ($variant) {
    //                     $variant->quantity -= $item->quantity;
    //                     $variant->save();
    //                 }
    //             } else {
    //                 $product = Product::find($item->product_id);
    //                 if ($product) {
    //                     $product->quantity -= $item->quantity;
    //                     $product->save();
    //                 }
    //             }
    //             // Xóa sản phẩm khỏi giỏ hàng
    //             CartDetail::find($item->id)->delete();
    //             // Kiểm tra nếu giỏ hàng không còn sản phẩm nào thì xóa luôn
    //             $remainingItems = CartDetail::where('cart_id', $item->cart_id)->count();
    //             if ($remainingItems === 0) {
    //                 Cart::where('id', $item->cart_id)->delete();
    //             }
    //             // return back()->with('success', 'Bạn đã đặt hàng thành công!');
    //             // Thằng ngu bỏ nó ra ngoài vòng lặp
    //         }
    //         // Trạng Thái đơn hàng
    //         try {
    //             Shipping::create([
    //                 'order_id' => $orderId,
    //                 'name' => 'Đơn hàng của bạn đã được đặt thành công',
    //                 'note' => 'Đơn hàng đang đợi được xác nhận',
    //             ]);
    //         } catch (\Exception $e) {
    //             Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
    //         }
    //         return back()->with('success', 'Bạn đã đặt hàng thành công!');
    //     } catch (\Exception $e) {
    //         Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());
    //     }
    // }

    // private function orderItems($items, $orderId)
    // {

    //     try {
    //         foreach ($items as $item) {
    //             Log::info('Xử lý item từ giỏ hàng:', [
    //                 'item_id' => $item->id,
    //                 'product_id' => $item->product_id ?? null,
    //                 'variant_id' => $item->variant_id ?? null,
    //                 'quantity' => $item->quantity,
    //                 'total_amount' => $item->total_amount
    //             ]);
    //             // Xử lý variant trước
    //             if ($item->variant_id) {
    //                 $variant = Variant::with('product')->find($item->variant_id);
    //                 if (!$variant || !$variant->product) {
    //                     throw new \Exception('Không tìm thấy biến thể hoặc sản phẩm của biến thể');
    //                 }

    //                 Log::info('Tìm thấy variant và sản phẩm:', [
    //                     'variant_id' => $variant->id,
    //                     'product_id' => $variant->product->id,
    //                     'product_name' => $variant->product->name,
    //                     'price' =>  $variant->product->price_sale ?? $variant->product->base_price,

    //                 ]);

    //                 // Lấy giá từ variant hoặc sản phẩm chính
    //                 $price = $variant->product->price_sale ?? $variant->product->base_price;
    //                 if (!$price) {
    //                     throw new \Exception('Không tìm thấy giá hợp lệ cho sản phẩm hoặc biến thể');
    //                 }

    //                 $orderDetail = OrderDetail::create([
    //                     'order_id' => $orderId,
    //                     'product_id' => $variant->product->id,
    //                     'variant_id' => $variant->id,
    //                     'quantity' => $item->quantity,
    //                     'price' => $price,
    //                     'total_price' => $item->quantity * $price,
    //                     'product_name' => $variant->product->name
    //                 ]);

    //                 // Cập nhật số lượng variant
    //                 $variant->quantity -= $item->quantity;
    //                 $variant->save();
    //             }
    //             // Xử lý sản phẩm thường
    //             else if ($item->product_id) {
    //                 $product = Product::find($item->product_id);
    //                 if (!$product) {
    //                     throw new \Exception('Không tìm thấy sản phẩm');
    //                 }

    //                 Log::info('Tìm thấy sản phẩm:', [
    //                     'product_id' => $product->id,
    //                     'product_name' => $product->name,
    //                     'price' => $product->price_sale ?? $product->base_price,
    //                 ]);

    //                 $price = $product->price_sale ?? $product->base_price;
    //                 if (!$price) {
    //                     throw new \Exception('Giá sản phẩm không hợp lệ');
    //                 }

    //                 $orderDetail = OrderDetail::create([
    //                     'order_id' => $orderId,
    //                     'product_id' => $product->id,
    //                     'variant_id' => null,
    //                     'quantity' => $item->quantity,
    //                     'price' => $price,
    //                     'total_price' => $item->quantity * $price,
    //                     'product_name' => $product->name
    //                 ]);

    //                 // Cập nhật số lượng sản phẩm
    //                 $product->quantity -= $item->quantity;
    //                 $product->save();
    //             } else {
    //                 throw new \Exception('Item không có product_id hoặc variant_id');
    //             }

    //             Log::info('Đã tạo chi tiết đơn hàng:', [
    //                 'order_detail_id' => $orderDetail->id,
    //                 'price' => $orderDetail->price,
    //                 'total_price' => $orderDetail->total_price
    //             ]);

    //             // Xóa item khỏi giỏ hàng
    //             CartDetail::find($item->id)->delete();

    //             // Kiểm tra và xóa giỏ hàng nếu trống
    //             $remainingItems = CartDetail::where('cart_id', $item->cart_id)->count();
    //             if ($remainingItems === 0) {
    //                 Cart::where('id', $item->cart_id)->delete();
    //             }
    //         }

    //         return true;
    //     } catch (\Exception $e) {
    //         Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());
    //         Log::error('Stack trace: ' . $e->getTraceAsString());
    //         throw $e;
    //     }
    // }



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
