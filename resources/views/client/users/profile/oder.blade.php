@extends('client.layouts.master')

@section('oder', 'active')

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
                                <div class="flex-shrink-0 mt-n2 mx-lg-0 mx-auto">
                                    <img src="{{ asset('admin') }}/assets/img/avatars/1.png" alt="user image"
                                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                                </div>
                                <div class="flex-grow-1 mt-3 mt-lg-5">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-invert-colors me-1 mdi-20px'></i><span
                                                        class="fw-medium">Thành viên</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-map-marker-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Việt Nam</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-calendar-blank-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Tham gia:
                                                        {{ Auth::user()->created_at->format('m/Y') }}
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
                                    <li class="d-flex align-items-center mb-3"><i class="mdi mdi-check mdi-24px"></i><span
                                            class="fw-medium mx-2">Trạng thái:</span>
                                        <span>{{ Auth::user()->status }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-star-outline mdi-24px"></i><span class="fw-medium mx-2">Vai
                                            trò:</span>
                                        <span>Thành viên</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3"><i class="mdi mdi-cash mdi-24px"></i><span
                                            class="fw-medium mx-2">Số dư:</span>
                                        <span>{{ number_format(Auth::user()->balance, 0, ',', '.') }}
                                            VNĐ</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-flag-outline mdi-24px"></i><span class="fw-medium mx-2">Quốc
                                            gia:</span> <span>Việt Nam</span></li>
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
                                    dòng thời gian</h5>
                            </div>
                            <div class="card-body pt-3 pb-0">
                                <ul class="timeline card-timeline mb-0">

                                    {{-- @if ($logs->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        Bạn chưa có hoạt động nào!
                                    </div>
                                @else
                                    @foreach ($logs as $item)
                                        <li
                                            class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-2 pb-1">
                                                    <h6 class="mb-0">Người dùng thực hiện</h6>
                                                    <small
                                                        class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                                                </div>
                                                <p class="text-muted mb-2">{{ $item->action }} </p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif --}}


                                </ul>
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
