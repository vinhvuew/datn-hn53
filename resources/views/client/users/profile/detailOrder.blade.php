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
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <!-- About User -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <small class="card-text text-uppercase">Thông tin</small>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-account-outline mdi-24px"></i><span class="fw-medium mx-2">Họ và
                                            tên: </span> <span>{{ Auth::user()->name }}</span>
                                    </li>


                                    <li class="d-flex align-items-center mb-3">
                                        <i class='mdi mdi-map-marker-outline mdi-24px'></i>
                                        <span class="fw-medium mx-2">Địa chỉ:
                                        </span><span>{{ Auth::user()->address }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3"><i class="mdi mdi-flag-outline mdi-24px"></i>
                                        <span class="fw-medium mx-2">Quốc
                                            gia:</span> <span>Việt Nam</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-1"><i
                                            class="mdi mdi-translate mdi-24px"></i><span class="fw-medium mx-2">Ngôn
                                            ngữ:</span> <span>Tiếng việt</span>
                                    </li>
                                </ul>
                                <small class="card-text text-uppercase">Liên hệ</small>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-phone-outline mdi-24px"></i><span class="fw-medium mx-2">Liên
                                            hệ:</span> <span>{{ Auth::user()->phone }}</span></li>
                                    <li class="d-flex align-items-center mb-1"><i
                                            class="mdi mdi-email-outline mdi-24px"></i><span
                                            class="fw-medium mx-2">Email:</span>
                                        <span>{{ Auth::user()->email }}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!--/ About User -->
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Chi tiết đơn hàng</h5>
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
                                                                        <span>{{ $item->product->name }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @if ($item->product->price_sale == '')
                                                                <td>{{ number_format($item->product->base_price, 0, ',', '.') }}
                                                                </td>
                                                            @else
                                                                <td>{{ number_format($item->product->price_sale, 0, ',', '.') }}
                                                                </td>
                                                            @endif
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
                                                                        <strong>{{ optional($item->variant)->product->name }}
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                                <span>
                                                                    @foreach ($item->variant->attributes as $attribute)
                                                                        @if (!$loop->first)
                                                                            <br>
                                                                        @endif
                                                                        {{ $attribute->attribute->name }}:
                                                                        @if (!$loop->first)
                                                                        @endif
                                                                        {{ $attribute->attributeValue->value }}.
                                                                    @endforeach

                                                                </span>
                                                            </td>
                                                            @if ($item->variant->product->price_sale == '')
                                                                <td>
                                                                    {{ number_format($item->variant->product->base_price, 0, ',', '.') }}
                                                                </td>
                                                            @else
                                                                <td>
                                                                    {{ number_format($item->variant->product->price_sale, 0, ',', '.') }}
                                                                </td>
                                                            @endif

                                                            {{-- <td>{{ number_format($item->variant->selling_price, 0, ',', '.') }} --}}
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->total_price, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Hoạt động vận chuyển</h5>
                                        @if ($order->status === 'pending')
                                            <form action="{{ route('profile.orders.cancel', $order->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger btn-sm">Hủy đơn hàng</button>
                                            </form>
                                        @elseif ($order->status === 'canceled')
                                            <button class="btn btn-danger btn-sm" disabled>Đơn hàng đã hủy</button>
                                        @elseif ($order->status === 'delivered')
                                            <form action="{{ route('profile.orders.confirm-received', $order->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('Bạn có chắc chắn đã nhận hàng?');">
                                                    Xác nhận đã nhận hàng
                                                </button>
                                            </form>
                                        @elseif ($order->status === 'completed')
                                            <button class="btn btn-success btn-sm" disabled>
                                                Đơn hàng đã hoàn thành
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
                                                @if ($item->name === 'Đơn hàng đã được nhận')
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
                                        <div class="d-flex justify-content-start align-items-center mb-4">
                                            <span
                                                class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                                    class='mdi mdi-cart-plus mdi-24px'></i></span>
                                            <h6 class="text-nowrap mb-0">{{ $order->count('user_id') }} Đơn Hàng</h6>
                                        </div>
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
                                <div class="mt-auto d-flex justify-content-end">
                                    <a class="btn btn-outline-secondary" href="{{ route('profile.myOder') }}">
                                        <i class="mdi mdi-arrow-left"></i> Quay lại
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-details").forEach(button => {
            button.addEventListener("click", function() {
                const targetId = this.getAttribute("data-target");
                const targetDiv = document.querySelector(targetId);
                targetDiv.classList.toggle("show");
            });
        });
    });
</script>
