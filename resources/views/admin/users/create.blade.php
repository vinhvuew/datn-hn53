@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header text-white text-center">
            <h4 class="mb-0">Thêm Người Dùng Mới</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ Và Tên</label>
                    <input type="text" name="name" class="form-control "
                        placeholder="Nhập Họ Tên Của Bạn" value="{{ old('name') }}" required>
                    
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Nhập Email Của Bạn" value="{{ old('email') }}" required autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        placeholder="Nhập SĐT Của Bạn" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật Khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Nhập Mật Khẩu Của Bạn" required autocomplete="new-password">
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác Thực Mật Khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password-confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Nhập lại Mật Khẩu Của Bạn" required>
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('password-confirmation', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small id="passwordError" class="text-danger" style="display: none;">Mật khẩu xác nhận không khớp!</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vai Trò</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

    document.getElementById("userForm").addEventListener("submit", function (event) {
        let password = document.getElementById("password").value;
        let passwordConfirm = document.getElementById("password-confirmation").value;
        let passwordError = document.getElementById("passwordError");

        if (password !== passwordConfirm) {
            event.preventDefault();
            passwordError.style.display = "block";
        } else {
            passwordError.style.display = "none";
        }
    });
</script>

@endsection
