@extends('client.layouts.master')
@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Cart page</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>VARIANT</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>  
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listCart as $cart)
                        @foreach ($cart->cartDetails as $cartDetail)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cartDetail->product->image) }}" width="50">
                                </td>
                                <td>{{ $cartDetail->product->name }}</td>
                                <td>{{ $cartDetail->variant ?? 'N/A' }}</td>
                                <td>{{ $cartDetail->quantity }}</td>
                                <td>${{ number_format($cartDetail->product->price * $cartDetail->quantity, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $cartDetail->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                
            </table>

            <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                <div class="col-sm-4 text-end">
                    <button type="button" class="btn_1 gray">Update Cart</button>
                </div>
                <div class="col-sm-8">
                    <div class="apply-coupon">
                        <div class="form-group">
                            <div class="row g-2">
                                <div class="col-md-6"><input type="text" name="coupon-code" value=""
                                        placeholder="Promo code" class="form-control"></div>
                                <div class="col-md-4"><button type="button" class="btn_1 outline">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /cart_actions -->

        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Subtotal</span> $240.00
                            </li>
                            <li>
                                <span>Shipping</span> $7.00
                            </li>
                            <li>
                                <span>Total</span> $247.00
                            </li>
                        </ul>
                        <a href="checkout.html" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->

    </main>
@endsection
