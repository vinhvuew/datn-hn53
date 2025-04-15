@extends('client.layouts.master')

@section('order', 'active')

@section('content')
    <main>
        <div class="content-wrapper" style="padding: 1px 0 250px;">
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="user-profile-header-banner">
                                <img src="{{ asset('admin') }}/assets/img/pages/profile-banner.png" alt="Banner image"
                                    class="rounded-top">
                            </div>
                            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-4">
                                <form action="{{ route('profile.updateAvatar') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="position-relative d-inline-block">
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="user image"
                                            class="d-block rounded-circle user-profile-img"
                                            style="width: 100px; height: 100px; object-fit: cover;">


                                        <label for="avatar-upload"
                                            class="position-absolute bottom-0 end-0 bg-white p-1 rounded-circle shadow"
                                            style="cursor: pointer;">
                                            <i class="fas fa-camera text-primary"></i>
                                        </label>
                                        <input type="file" id="avatar-upload" name="avatar" class="d-none"
                                            onchange="this.form.submit()">
                                    </div>
                                </form>
                                <div class="flex-grow-1 mt-3 mt-lg-5">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">

                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-map-marker-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Việt Nam</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-calendar-blank-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Tham gia:
                                                        {{ Auth::user()->created_at->format('d/m/Y') }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-warning text-dark fw-bold">
                                            <i class='mdi mdi-account-check-outline me-1'></i>Đã kết nối
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Header -->

                @include('client.users.profile.layouts.Navbar')

                <!-- User Profile Content -->
                <div class="row">
                    <div class="col-xl-12 col-lg-11 col-md-11">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Chi tiết đơn hàng #{{ $order->id }}</h5>
                                    </div>
                                    <div class="card-datatable table-responsive">
                                        <table class="datatables-order-details table">
                                            <thead>
                                                <tr>
                                                    <th class="w-50">Sản Phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderDetails as $item)
                                                    @if ($item->product)
                                                        <tr>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center">
                                                                    <div class="avatar me-2 pe-1">
                                                                        @if ($item->product->img_thumbnail)
                                                                            <img class="rounded-2"
                                                                                src="{{ Storage::url($item->product->img_thumbnail) }}"
                                                                                width="50px" alt="">
                                                                        @else
                                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                                width="50px" alt="Default Image">
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <strong>{{ $item->product_name }}</strong>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ number_format($item->price, 0, ',', '.') }}
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->total_price, 0, ',', '.') }} VND
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center mb-1">
                                                                    <div class="avatar me-2 pe-1">
                                                                        @if ($item->variant && $item->variant->product->img_thumbnail)
                                                                            <img class="rounded-2"
                                                                                src="{{ Storage::url($item->variant->product->img_thumbnail) }}"
                                                                                width="50px" alt="">
                                                                        @else
                                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                                width="50px" alt="Default Image">
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <strong>{{ $item->product_name }}</strong>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $attributes = explode(
                                                                        ' - ',
                                                                        $item->variant_attribute,
                                                                    );
                                                                    $values = explode(' - ', $item->variant_value);
                                                                @endphp

                                                                <span class="block text-sm text-gray-700">
                                                                    @foreach ($attributes as $index => $attribute)
                                                                        {{ $attribute }}: {{ $values[$index] ?? '' }}
                                                                        @if (!$loop->last)
                                                                            |
                                                                        @endif
                                                                    @endforeach
                                                                </span>

                                                            </td>
                                                            <td>
                                                                {{ number_format($item->price, 0, ',', '.') }}
                                                            </td>
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->total_price, 0, ',', '.') }}
                                                            </td>
                                                    @endif
                                                @endforeach
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mã voucher
                                                    </th>
                                                    <th>
                                                        voucher
                                                    </th>
                                                    <th>
                                                        Giảm giá
                                                    </th>
                                                    <th>
                                                        Số tiền đã giảm
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $order->voucher_code }}
                                                    </td>
                                                    <td>
                                                        {{ $order->voucher_name }}
                                                    </td>
                                                    <td>
                                                        {{ $order->voucher_discount_type == 'percentage'
                                                            ? number_format($order->voucher_discount_value, 0) . '%'
                                                            : number_format($order->voucher_discount_value, 0) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->voucher_discount_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end align-items-center m-3 p-1">
                                            <div class="order-calculations">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="w-px-100 text-heading fw-bold">Tổng cộng:</span>
                                                    <h6 class="mb-0">
                                                        {{ number_format($item->order->total_price, 0, ',', '.') }} VND
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- hoạt động vận chuyển --}}
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Hoạt động vận chuyển</h5>
                                        @if ($order->status === 'pending')
                                            @if ($order->payment_method === 'VNPAY_DECOD' && $order->payment_status === 'Chờ thanh toán')
                                                <form action="{{ route('vnpay.repay', $order->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Thanh toán
                                                        lại</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('profile.orders.cancel', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger btn-sm">Hủy đơn hàng</button>
                                            </form>
                                        @elseif ($order->status === 'canceled')
                                            <button class="btn btn-danger btn-sm" disabled>Đơn hàng đã hủy</button>
                                            {{-- @elseif ($order->status === 'completed')
                                            <form action="{{ route('profile.orders.received', $order->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('Bạn có chắc chắn đã nhận hàng?');">
                                                    Đã nhận hàng
                                                </button>
                                            </form> --}}
                                        @elseif ($order->status === 'completed')
                                            <div class="d-flex align-items-center">
                                                <a class="btn btn-outline-danger btn-sm me-2"
                                                    href="{{ route('profile.refund', $order->id) }}">
                                                    Trả hàng / Hoàn tiền
                                                </a>
                                                <form action="{{ route('profile.orders.order_confirmation', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-outline-success btn-sm"
                                                        onclick="return confirm('Sau khi xác nhận đơn hàng đồng nghĩa với việc bạn đồng ý với chính sách của Shop');">
                                                        Xác nhận đơn hàng
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($order->status === 'order_confirmation')
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="text-success">
                                                    ĐƠN HÀNG HOÀN THÀNH
                                                </span>
                                                <a href="http://" class="text-decoration-none text-primary">
                                                    Đánh giá
                                                </a>
                                            </div>
                                        @elseif ($order->status === 'refund_completed')
                                            <button class="btn btn-outline-success btn-sm">
                                                Đã hoàn tiền thành công
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm" disabled>Đơn hàng đang được xử
                                                lý</button>
                                        @endif
                                    </div>
                                    <div class="card-body mt-3">
                                        <ul class="timeline pb-0 mb-0">
                                            @php
                                                $hasReceived = false;
                                            @endphp

                                            @foreach ($events as $item)
                                                @if ($item->name === 'Giao hàng thành công')
                                                    @php $hasReceived = true; @endphp
                                                @endif
                                            @endforeach

                                            @foreach ($events as $item)
                                                @if ($item->name !== 'Đang giao hàng' && $item->name !== 'Giao hàng thành công')
                                                    <li
                                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                                        <span class="timeline-point-wrapper"> <span
                                                                class="timeline-point timeline-point-primary"></span>
                                                        </span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                                <span
                                                                    class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                                    |
                                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                                            </div>
                                                            <p class="mt-2">{{ $item->note }}</p>
                                                            @if ($item->image)
                                                                <!-- Ảnh nhỏ có sự kiện click -->
                                                                <img src="{{ Storage::url($item->image) }}"
                                                                    class="rounded-2" width="50px"
                                                                    style="cursor:pointer"
                                                                    onclick="showImageModal('{{ Storage::url($item->image) }}')">
                                                            @endif
                                                            <!-- Modal hiển thị ảnh lớn -->
                                                            <div id="imageModal" onclick="this.style.display='none'"
                                                                style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:9999; justify-content:center; align-items:center;">
                                                                <img id="modalImage" src=""
                                                                    style="max-width:90%; max-height:90%; border-radius:8px;">
                                                            </div>
                                                        </div>
                                                    </li>
                                                @elseif ($item->name === 'Đang giao hàng')
                                                    {{-- Hiển thị "Giao hàng thành công" nếu chưa có trong danh sách --}}
                                                    @if (!$hasReceived)
                                                        <li class="timeline-item timeline-item-transparent">
                                                            <span class="timeline-point-wrapper"> <span
                                                                    class="timeline-point timeline-point-secondary"></span>
                                                            </span>
                                                            <div class="timeline-event">
                                                                <div class="timeline-header">
                                                                    <h6 class="mb-0 mt-1">Giao hàng thành công</h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    {{-- Hiển thị trạng thái "Đang giao hàng" --}}
                                                    <li
                                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                                        <span class="timeline-point-wrapper"> <span
                                                                class="timeline-point timeline-point-primary"></span>
                                                        </span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                                <span
                                                                    class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                                    |
                                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                                            </div>
                                                            <p class="mt-2">{{ $item->note }}</p>
                                                        </div>
                                                    </li>
                                                @elseif ($item->name === 'Giao hàng thành công')
                                                    <li
                                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                                        <span class="timeline-point-wrapper"> <span
                                                                class="timeline-point timeline-point-primary"></span></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                                <span
                                                                    class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                                    |
                                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                                            </div>
                                                            <p class="mt-2">{{ $item->note }}</p>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title mb-4">Chi tiết khách hàng</h6>
                                        <div class="d-flex justify-content-start align-items-center mb-4">
                                            <div class="avatar me-2">
                                                @if ($order->user->avatar)
                                                    <img src="{{ Storage::url($order->user->avatar) }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @else
                                                    <img src="{{ asset('themes/image/logo.jpg') }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @endif

                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="app-user-view-account.html">
                                                    <h6 class="mb-1">{{ $order->user->name }}</h6>
                                                </a>
                                                <small>Mã khách hàng: #{{ $order->user->id }}</small>
                                            </div>
                                        </div>
                                        {{-- đơn hàng --}}
                                        {{-- <div class="d-flex justify-content-start align-items-center mb-4">
                                            <span
                                                class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                                    class='mdi mdi-cart-plus mdi-24px'></i></span>
                                            <h6 class="text-nowrap mb-0">{{ $order->count('user_id') }} Đơn Hàng</h6>
                                        </div> --}}
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-2">Thông tin liên lạc</h6>
                                        </div>
                                        <p class=" mb-1">Email: {{ $order->user->email }}</p>
                                        <p class=" mb-0">Số điện thoại: {{ $order->user->phone }}</p>
                                    </div>
                                </div>

                                <div class="card mb-4">

                                    <div class="card-header d-flex justify-content-between">
                                        <h6 class="card-title m-0">Địa chỉ giao hàng</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">Địa chỉ: {{ $order->address->address }},
                                            {{ $order->address->ward }}
                                            <br> {{ $order->address->district }}
                                            <br>Tỉnh/Thành Phố: {{ $order->address->province }}
                                            {{ $order->user_address }}<br>Việt Nam
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="btn btn-outline-secondary" href="{{ route('profile.myOder') }}">
                                        <i class="mdi mdi-arrow-left me-1"></i>Quay lại
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ User Profile Content -->
            </div>
        </div>
    </main>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/pages/page-profile.css" />
    <style>
        a {
            color: #4C5671;
        }

        .rts-header__menu ul li a {
            color: #000000;
        }

        .rts-header__right .login__btn {
            border: 1px solid #000000;
            color: #000000;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #9055fd;
            color: #fff;
        }
    </style>
@endsection
@section('script-libs')
    <script>
        function showImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = src;
            modal.style.display = 'flex';
        }
    </script>
@endsection
