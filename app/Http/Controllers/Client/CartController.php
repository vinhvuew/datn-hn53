<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;

class CartController extends Controller
{
    public function cart()
    {
        $carts = CartDetail::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['product', 'variant'])->get();

        return view('client.cart.listCart', compact('carts'));
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
