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
                                                    <i class='mdi mdi-invert-colors me-1 mdi-20px'></i>
                                                    <span class="fw-medium">
                                                        @switch(Auth::user()->role)
                                                            @case('user')
                                                                Thành viên
                                                            @break

                                                            @case('admin')
                                                                Quản trị
                                                            @break

                                                            @case('moderator')
                                                                Nhân viên
                                                            @break

                                                            @default
                                                                Không xác định
                                                        @endswitch
                                                    </span>
                                                </li>

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

                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-star-outline mdi-24px"></i><span class="fw-medium mx-2">Vai
                                            trò:</span>
                                        <span>
                                            @switch(Auth::user()->role)
                                                @case('user')
                                                    Thành viên
                                                @break

                                                @case('admin')
                                                    Quản trị
                                                @break

                                                @case('moderator')
                                                    Nhân viên
                                                @break

                                                @default
                                                    Không xác định
                                            @endswitch
                                        </span>
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
                        <!-- Activity Timeline -->
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-chart-timeline-variant mdi-24px me-2'></i>Hoạt
                                    động,
                                    Đơn hàng của tôi</h5>
                            </div>
                            <div class="card-body pt-3 pb-0">
                                <div class="col-xl-12 mb-5">
                                    <div class="list-group">
                                        @foreach ($orders as $order)
                                            <div class="list-group-item">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5>Đơn hàng #{{ $order->id }}</h5>
                                                        <p>Ngày đặt: {{ $order->order_date }}</p>
                                                        <p>Trạng thái: <span
                                                                class="badge bg-warning">{{ $order->payment_status ?? 'Đang xử lý' }}</span>
                                                        </p>
                                                        <p>Tổng tiền:
                                                            <strong>{{ number_format($order->total_price, 0, ',', '.') }}
                                                                VNĐ</strong>
                                                        </p>
                                                    </div>
                                                    <button class="btn btn-primary toggle-details"
                                                        data-target="#orderDetails{{ $order->id }}">Xem chi
                                                        tiết</button>
                                                </div>
                                                <div class="collapse mt-3" id="orderDetails{{ $order->id }}">
                                                    <ul class="list-group">
                                                        @foreach ($order->orderDetails as $detail)
                                                            <li class="list-group-item">
                                                                @if ($detail->variant)
                                                                    {{ $detail->variant->name ?? 'Biến thể không tồn tại' }}
                                                                @elseif ($detail->product)
                                                                    {{ $detail->product->name ?? 'Sản phẩm không tồn tại' }}
                                                                @else
                                                                    Sản phẩm không xác định
                                                                @endif
                                                                -
                                                                {{ number_format($detail->price, 0, ',', '.') }} VNĐ
                                                                (x{{ $detail->quantity }})
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Activity Timeline -->
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
