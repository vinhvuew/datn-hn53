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
            ->where('is_selected', 1)
            ->get();
        // dd($cart_detail);

        // dd($cart_detail);
        // return response()->json($cart_detail);
        // dd($cart_detail);

        try {
            if ($cart_detail->isEmpty())
                return response()->json(['error' => 'Giỏ hàng trống'], 400);
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
                    $orderdatail = $this->orderItems($cart_detail, $order->id, $cart->id);
                    // dd($orderdatail);
                    if (!$orderdatail) {
                        return response()->json(['status' => 'error', 'message' => 'Lỗi khi thêm chi tiết đơn hàng!'], 500);
                    }
                    // dd($orderdatail);
                    return view('client.checkout.complete');
                    break;
                default:
                    return response()->json(['status' => 'error', 'message' => 'Phương thức thanh toán không hợp lệ!'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage()]);
        }
    }
    private function createOrder($request, $status)
    {
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status_id' => 1,
                'total_price' => $request->total_price,
                'address_id' => $request->address_id,
                'payment_method' => $request->payment_method,
                'payment_status' => $status,
                'order_date' => now(),
                'voucher_id' => $request->voucher_id ?? null,
            ]);

            return $order; // Trả về đơn hàng vừa tạo nếu thành công
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            return null; // Hoặc có thể throw exception để xử lý ở tầng cao hơn
        }
    }
    private function orderItems($items, $orderId, $cart_id)
    {
        try {
            foreach ($items as $item) {
                // dd($item);
                $oder = OrderDetail::create([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id ?? null,
                    'variant_id' => $item->variant_id ?? null,
                    'quantity' => $item->quantity,
                    'price' => $item->variant_id
                        ? optional($item->variant)->selling_price ?? 0
                        : optional($item->product)->base_price ?? 0,
                    'total_price' => $item->total_amount,
                ]);
                $cartDetail = CartDetail::query()->with('cart')->find($item->id);

                if (!$cartDetail) {
                    return back()->with('error', 'Giỏ hàng không tồn tại!');
                }
                // Lấy cart_id trước khi xóa chi tiết
                $cartId = $cartDetail->cart_id;
                // Xóa chi tiết giỏ hàng
                $cartDetail->delete();

                // Kiểm tra nếu giỏ hàng không còn sản phẩm nào thì xóa luôn
                $remainingItems = CartDetail::where('cart_id', $cartId)->count();
                if ($remainingItems === 0) {
                    Cart::where('id', $cartId)->delete();
                }
                return back()->with('success', 'Bạn đã đặt hàng thành công!');
                // dd($oder);
            }
            // Xóa sản phẩm trong giỏ hàng sau khi đã tạo chi tiết đơn hàng
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm vào đơn hàng: ' . $e->getMessage());

            // Nếu có lỗi, có thể ném ngoại lệ hoặc trả về false để xử lý sau
            return false;
        }

        return true; // Trả về true nếu không có lỗi
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
