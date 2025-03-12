@extends('client.layouts.master')

@section('info', 'active')

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
                                {{-- avata --}}
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
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <!-- Activity Timeline -->
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-chart-timeline-variant mdi-24px me-2'></i>cập nhật thông tin</h5>
                            </div>
                            <div class="card-body pt-3 pb-0">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ Auth::user()->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ Auth::user()->address }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!--/ Activity Timeline -->
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        @if (session('successp'))
                            <div class="alert alert-success">
                                {{ session('successp') }}
                            </div>
                        @endif
                            
                        <!-- About User -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">Thay đổi mật khẩu</h5>
                                </div>
                                <form action="{{ route('profile.updatePassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-3 position-relative">
                                        @error('current_password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('current_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        @error('new_password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <label for="new_password" class="form-label">Mật khẩu mới</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('new_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        @error('new_password_confirmation')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="new_password_confirmation">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('confirm_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ About User -->
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
    function togglePassword(fieldId) {
        let field = document.getElementById(fieldId);
        let icon = field.nextElementSibling.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("mdi-eye-off-outline");
            icon.classList.add("mdi-eye-outline");
        } else {
            field.type = "password";
            icon.classList.remove("mdi-eye-outline");
            icon.classList.add("mdi-eye-off-outline");
        }
    }
</script>
