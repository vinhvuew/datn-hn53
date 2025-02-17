@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header text-white text-center">
                <h4 class="mb-0">Thêm Người Dùng Mới</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Họ Và Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập Họ Tên Của Bạn"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập Email Của Bạn"
                            value="{{ old('email') }}" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="tel" name="phone" class="form-control" placeholder="Nhập SĐT Của Bạn"
                            value="{{ old('phone') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Nhập Mật Khẩu Của Bạn" required autocomplete="new-password">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="togglePassword('password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác Thực Mật Khẩu</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password-confirmation"
                                class="form-control" placeholder="Nhập lại Mật Khẩu Của Bạn" required>
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="togglePassword('password-confirmation', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vai Trò</label>
                        <select name="role" class="form-select" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100">Thêm Mới User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, btn) {
            let input = document.getElementById(fieldId);
            let icon = btn.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>


@endsection
