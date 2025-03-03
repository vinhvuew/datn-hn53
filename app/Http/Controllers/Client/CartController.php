<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function cart()
    {
        try {
            // Kiểm tra nếu user chưa đăng nhập
            if (!Auth::check()) {
                return redirect()->route('home')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
            }

            $cart = Cart::where('user_id', Auth::id())->first();
            // dd($cart);
            // Nếu không có giỏ hàng, trả về danh sách rỗng
            $carts = $cart ? $cart->cartDetails()->with(['product', 'variant'])->get() : [];

            return view('client.cart.listCart', compact('carts'));
        } catch (\Exception $e) {
            // Ghi log lỗi nếu cần
            Log::error('Lỗi khi lấy giỏ hàng: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tải giỏ hàng. Vui lòng thử lại.');
        }
    }

    public function updateCart(Request $request)
    {
        $cartDetail = CartDetail::findOrFail($request->cart_id);
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();

        // Tính lại subtotal cho từng sản phẩm
        $newSubtotal = number_format($cartDetail->quantity * ($cartDetail->product->price ?? 0));

        // Tính lại tổng tiền của toàn bộ giỏ hàng
        $newTotal = number_format(
            CartDetail::whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })->get()->sum(fn($cart) => $cart->quantity * ($cart->product->price ?? 0))
        );

        return response()->json([
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal
        ]);
    }


    public function destroy($id)
    {
        CartDetail::findOrFail($id)->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
