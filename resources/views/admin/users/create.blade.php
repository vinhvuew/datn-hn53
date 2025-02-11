@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

<div class="container">
    <h1>Add New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Họ Và Tên</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập Họ Tên Của Bạn" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập Email Của Bạn" value="{{ old('email') }}" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Số Điện Thoại</label>
            <input type="phone" name="phone" class="form-control" placeholder="Nhập SĐT Của Bạn" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label>Mật Khẩu</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Nhập Mật Khẩu Của Bạn" required autocomplete="new-password">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="toggle-password" onclick="togglePasswordVisibility()">Ẩn</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Xác Thực Mật Khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password-confirmation" class="form-control" placeholder="Nhập lại Mật Khẩu Của Bạn" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="toggle-password-confirmation" onclick="togglePasswordConfirmationVisibility()">Ẩn</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Thêm Mới User</button>
    </form>
</div>

<script>
    //  mật khẩu hiển thị
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleButton = document.getElementById("toggle-password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.textContent = "Ẩn";
        } else {
            passwordField.type = "password";
            toggleButton.textContent = "Hiển thị";
        }
    }

    //  nhập lại mật khẩu hiển thị
    function togglePasswordConfirmationVisibility() {
        var confirmPasswordField = document.getElementById("password-confirmation");
        var toggleButton = document.getElementById("toggle-password-confirmation");

        if (confirmPasswordField.type === "password") {
            confirmPasswordField.type = "text";
            toggleButton.textContent = "Ẩn";
        } else {
            confirmPasswordField.type = "password";
            toggleButton.textContent = "Hiển thị";
        }
    }
</script>

@endsection
