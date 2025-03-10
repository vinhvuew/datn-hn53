@extends('client.layouts.master')

@section('content')
    <main>
        @if ($carts)
            <div class="container">
                <h2 class="text-center mb-4">🛒 Giỏ Hàng</h2>
                <table class="table">
                    <thead>
                        <tr>
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
                                    <td><img src="{{ Storage::url($cart->variant->image) }}" alt="" width="50px"
                                            class="rounded-2"></td>
                                    <td>{{ Str::limit($cart->variant->product->name, 30) }}</td>
                                    <td>
                                        {{ number_format($cart->variant->selling_price, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="col-2">
                                        <form class="update-cart-form" data-cart-id="{{ $cart->id }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="item-quantity d-flex align-items-center">
                                                <input type="number" name="quantity"
                                                    class="form-control quantity-input w-50" data-id="{{ $cart->id }}"
                                                    value="{{ $cart->quantity }}" min="1">
                                            </div>
                                        </form>
                                    </td>
                                    <td id="total-amount-{{ $cart->id }}">
                                        @php
                                            $money = $cart->total_amount;
                                            $totalAmount += $money;
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
                                                    value="{{ $cart->quantity }}" min="1">
                                            </div>

                                            <input type="hidden" name="price_sale"
                                                value="{{ $cart->product->price_sale }}">

                                        </form>
                                    </td>
                                    <td id="total-amount-{{ $cart->id }}">
                                        @php
                                            $money = $cart->total_amount;
                                            $totalAmount += $money;
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
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <div class="text-end mb-5 p-4 ">
                    <h4 class="fw-bold text-primary">
                        Tổng tiền:
                        <span id="overall-total" class="text-danger">
                            {{ number_format($totalAmount, 0, ',', '.') }} VNĐ
                        </span>
                    </h4>
                    <a href="{{route("checkout.view")}}" class="btn btn-success btn-lg mt-2 px-4 fw-bold">
                        <i class="fas fa-shopping-cart"></i> Thanh toán
                    </a>
                </div>

            </div>
        @else
            <div class="empty-cart-box text-center mt-5" id="empty-cart" style="margin-bottom: 140px; ">
                <img class="mb-4 mt-5" src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                    alt="Empty Cart" width="300px">
                <h4 class="text-secondary" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</h4>
                <p style="font-size: 14px; color: #888;">Giỏ hàng của bạn đang trống.
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
            $('.quantity-input').on('input', function() {
                let id = $(this).data('id');
                let quantity = $(this).val();

                if (quantity < 0) {
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
                            // Hiển thị thông báo thành công
                            notyf.success(response.message);

                            // Cập nhật tổng tiền cho từng sản phẩm
                            $('#total-amount-' + id).text(response.totalAmountFormatted);

                            // Cập nhật tổng tiền giỏ hàng
                            $('#overall-total').text(response.overallTotalFormatted);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            // Xóa sản phẩm khỏi giỏ hàng
            $(document).ready(function() {
                $('.btn-delete').on('click', function() {
                    let id = $(this).data('id');

                    if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                        return;
                    }

                    $.ajax({
                        url: '/cart/delete/' + id, // Cập nhật đường dẫn API đúng chuẩn
                        type: 'DELETE', // Sử dụng phương thức DELETE đúng chuẩn RESTful
                        data: {
                            _token: '{{ csrf_token() }}' // Bảo mật CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                // Xóa sản phẩm khỏi giao diện
                                $('#cart-item-' + id).remove();

                                // Cập nhật tổng tiền giỏ hàng
                                $('#overall-total').text(response
                                    .overallTotalFormatted);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.responseJSON.message);
                        }
                    });
                });
            });
        });
    </script>
    <script>
        $('.delete-cart-form').submit(function(event) {
            event.preventDefault(); // Ngừng reload trang
            var form = $(this);
            var cartId = form.data('id');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    notyf.success(response.message);
                    // Nếu xóa thành công, xóa dòng sản phẩm khỏi bảng
                    form.closest('tr').remove();

                    // Cập nhật tổng tiền nếu cần
                    if (response.overallTotalFormatted) {
                        $('#overall-total').text(response.overallTotalFormatted);
                        $('#overall-totals').text(response.overallTotalFormatted);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra khi xóa sản phẩm');
                }
            });
        });
    </script>
@endsection
