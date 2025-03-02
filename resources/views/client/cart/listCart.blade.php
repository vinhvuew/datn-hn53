@extends('client.layouts.master')
@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
                <h1>Shopping Cart</h1>
            </div>
            <a href="" class="btn btn-info">Đặt Hàng</a>
            @if (count($carts) > 0)
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <div class="thumb_cart">
                                        @if ($cart->variant)
                                            <img src="{{ Storage::url($cart->variant->img_thumbnail) }}"
                                                alt="{{ $cart->variant->name }}" class="rounded me-2" width="80">
                                            <span>{{ $cart->variant->name }}</span>
                                        @elseif ($cart->product)
                                            <img src="{{ Storage::url($cart->product->img_thumbnail) }}"
                                                alt="{{ $cart->product->name }}" class="rounded me-2" width="80">
                                            <span>{{ $cart->product->name }}</span>
                                        @else
                                            <span class="text-danger">Product not found</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>
                                        @if ($cart->variant)
                                            ${{ number_format($cart->variant->price_sale) }}
                                        @elseif ($cart->product)
                                            ${{ number_format($cart->product->price_sale) }}
                                        @else
                                            N/A
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <button type="button" class="dec button_inc"
                                            data-id="{{ $cart->id }}"></button>
                                        <input type="number" min="1" value="{{ $cart->quantity }}"
                                            class="qty2 form-control text-center" data-id="{{ $cart->id }}">
                                        <button type="button" class="inc button_inc"
                                            data-id="{{ $cart->id }}"></button>
                                    </div>
                                </td>
                                <td>
                                    <strong class="subtotal" data-id="{{ $cart->id }}">
                                        ${{ number_format(($cart->variant ? $cart->variant->price : ($cart->product ? $cart->product->price : 0)) * $cart->quantity) }}
                                    </strong>
                                </td>
                                <td class="options">
                                    <a href="{{ route('cart.destroy', ['id' => $cart->id]) }}" class="text-danger"><i
                                            class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="box_cart">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <ul>
                                    <li><span>Total</span> <span class="total-price">
                                            ${{ number_format($carts->sum(fn($cart) => ($cart->variant ? $cart->variant->price : ($cart->product ? $cart->product->price : 0)) * $cart->quantity)) }}
                                        </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h4>Giỏ hàng của bạn đang trống!</h4>
                    <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                </div>
            @endif
        </div>
    </main>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateCart(cartId, quantity) {
            fetch("{{ route('cart.update') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        cart_id: cartId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector(`.subtotal[data-id="${cartId}"]`).innerText =
                        `$${data.newSubtotal}`;
                    document.querySelector('.total-price').innerText = `$${data.newTotal}`;
                });
        }

        document.querySelectorAll('.button_inc').forEach(button => {
            button.onclick = function() {
                let row = this.closest('.numbers-row');
                let input = row.querySelector('.qty2');
                let quantity = parseInt(input.value);
                let cartId = input.getAttribute('data-id');

                if (this.classList.contains('inc')) {
                    quantity+1;
                } else if (this.classList.contains('dec') && quantity > 1) {
                    quantity-1;
                }

                input.value = quantity;
                updateCart(cartId, quantity);
            };
        });

        document.querySelectorAll('.qty2').forEach(input => {
            input.onchange = function() {
                let quantity = parseInt(this.value);
                let cartId = this.getAttribute('data-id');

                if (quantity < 1 || isNaN(quantity)) {
                    this.value = 1;
                    quantity = 1;
                }

                updateCart(cartId, quantity);
            };
        });
    });
</script>
