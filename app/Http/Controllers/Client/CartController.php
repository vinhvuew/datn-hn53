<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\CartDetail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cart = Auth::check() ? Cart::where('user_id', Auth::id())->first() : null;
        // dd($cart);
        $cart = Auth::check()
            ? Cart::where('user_id', Auth::id())->first()
            : session()->get('guest_cart', null);

        $carts = $cart ? ($cart instanceof Cart ? $cart->cartDetails()->with(['product', 'variant'])->get() : $cart) : [];
        dd($carts);
        return view('client.cart.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CartDetail::findOrFail($id)->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
