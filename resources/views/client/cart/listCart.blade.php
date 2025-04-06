@extends('client.layouts.master')

@section('content')
    <main>
        @if ($carts)
            <div class="container mt-4">
                <h2 class="text-center mb-4">🛒 Giỏ Hàng</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Chọn
                                {{-- <input type="checkbox" id="select-all"> --}}
                            </th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    @php
                        $totalAmount = 0;
                    @endphp

                    @foreach ($carts as $cart)
                        @if ($cart->variant)
                            <tbody id="cart-item-{{ $cart->id }}">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-item-checkbox" data-id="{{ $cart->id }}"
                                            data-price="{{ $cart->total_amount }}" name="selected_items[]"
                                            value="{{ $cart->id }}" {{ $cart->is_selected ? 'checked' : '' }}>
                                    </td>
                                    <td><img src="{{ Storage::url($cart->variant->image) }}" alt="" width="50px"
                                            class="rounded-2"></td>
                                    <td>{{ Str::limit($cart->variant->product->name, 30) }}</td>
                                    <td>
                                        @if ($cart->variant->product->price_sale)
                                            {{ number_format($cart->variant->product->price_sale, 0, ',', '.') }} VNĐ
                                        @else
                                            {{ number_format($cart->variant->product->base_price, 0, ',', '.') }} VNĐ
                                        @endif
                                    </td>
                                    <td class="col-2">
                                        <form class="update-cart-form" data-cart-id="{{ $cart->id }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="item-quantity d-flex align-items-center">
                                                <input type="number" name="quantity"
                                                    class="form-control quantity-input w-50" data-id="{{ $cart->id }}"
                                                    value="{{ $cart->quantity }}" min="1"
                                                    data-max="{{ $cart->variant->quantity }}">
                                            </div>
                                        </form>
                                    </td>
                                    <td id="total-amount-{{ $cart->id }}">
                                        @php
                                            if ($cart->is_selected) {
                                                $money = $cart->total_amount;
                                                $totalAmount += $money;
                                            }
                                        @endphp
                                        {{ number_format($cart->total_amount, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td>
                                        <form class="delete-cart-form" data-id="{{ $cart->id }}"
                                            action="{{ route('cart.delete', $cart->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @elseif ($cart->product)
                            <tbody id="cart-item-{{ $cart->id }}">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-item-checkbox" data-id="{{ $cart->id }}"
                                            data-price="{{ $cart->total_amount }}" name="selected_items[]"
                                            value="{{ $cart->id }}" {{ $cart->is_selected ? 'checked' : '' }}>
                                    </td>
                                    <td><img src="{{ Storage::url($cart->product->img_thumbnail) }}" alt=""
                                            height="50px" width="40px">
                                    </td>
                                    <td>{{ Str::limit($cart->product->name, 30) }} </td>
                                    <td>
                                        @if ($cart->product->price_sale)
                                            {{ number_format($cart->product->price_sale, 0, ',', '.') }} VNĐ
                                        @else
                                            {{ number_format($cart->product->base_price, 0, ',', '.') }} VNĐ
                                        @endif
                                    </td>
                                    <td class="col-2">
                                        <form class="update-cart-form" data-cart-id="{{ $cart->id }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="item-quantity d-flex align-items-center">
                                                <input type="number" name="quantity"
                                                    class="form-control quantity-input w-50" data-id="{{ $cart->id }}"
                                                    value="{{ $cart->quantity }}" min="1"
                                                    data-max="{{ $cart->product->quantity }}">
                                            </div>
                                        </form>
                                    </td>
                                    <td id="total-amount-{{ $cart->id }}">
                                        @php
                                            if ($cart->is_selected) {
                                                $money = $cart->total_amount;
                                                $totalAmount += $money;
                                            }
                                        @endphp
                                        {{ number_format($cart->total_amount, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td>
                                        <form class="delete-cart-form" data-id="{{ $cart->id }}"
                                            action="{{ route('cart.delete', $cart->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
                <form id="checkout-form" action="{{ route('checkout.post') }}" method="POST">
                    @csrf
                    <div class="text-end mb-5 p-4">
                        <h4 class="fw-bold text-primary">
                            Tổng tiền: <span id="overall-total" class="text-danger">
                                {{ number_format($totalAmount, 0, ',', '.') }} VNĐ
                            </span>
                        </h4>
                        <button type="submit" class="btn btn-success btn-lg mt-2 px-4 fw-bold">
                            <i class="fas fa-shopping-cart"></i> Thanh toán
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="empty-cart-box text-center" id="empty-cart" style=" margin-top: 140px;">
                <img class="mb-5" src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                    alt="Empty Cart" width="300px">
                <h4 class="text-secondary mt-5" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</h4>
                <p style="font-size: 14px; color: #ca4d17;">Giỏ hàng của bạn đang trống.
                    Hãy chọn thêm sản phẩm để mua sắm nhé</p>
                <a href="{{ route('home') }}" class="btn btn-danger mb-5">
                    Quay Lại Trang Chủ
                </a>
            </div>
        @endif
    </main>
@endsection
@section('script-libs')
    <script>
        $(document).ready(function() {
            function updateOverallTotal() {
                let total = 0;
                $('.cart-item-checkbox:checked').each(function() {
                    let itemId = $(this).data('id');
                    let itemTotal = parseFloat($('#total-amount-' + itemId).text().replace(/[^\d]/g, ''));
                    total += itemTotal;
                });
                $('#overall-total').text(total.toLocaleString('vi-VN') + ' VNĐ');
            }

            // Cập nhật số lượng sản phẩm
            $('.quantity-input').on('input', function() {
                let id = $(this).data('id');
                let quantity = $(this).val();

                if (quantity < 1) {
                    alert('Số lượng không hợp lệ!');
                    return;
                }

                $.ajax({
                    url: '/cart/update/' + id,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#total-amount-' + id).text(response.totalAmountFormatted);
                            updateOverallTotal();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            // Cập nhật tổng tiền khi chọn/bỏ chọn sản phẩm
            $('.cart-item-checkbox').on('change', function() {
                updateOverallTotal();
            });

            // Xử lý form thanh toán
            $('#checkout-form').on('submit', function(e) {
                e.preventDefault();

                let selectedItems = $('.cart-item-checkbox:checked');
                if (selectedItems.length === 0) {
                    alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
                    return;
                }

                // Cập nhật trạng thái chọn sản phẩm
                let updatePromises = selectedItems.map(function() {
                    let id = $(this).data('id');
                    return $.ajax({
                        url: '/cart/update-selection/' + id,
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_selected: 1
                        }
                    });
                });

                // Sau khi cập nhật xong, submit form
                Promise.all(updatePromises).then(function() {
                    e.target.submit();
                });
            });
        });
    </script>
@endsection
