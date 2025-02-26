<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập & Đăng Ký</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/login.css') }}">
    <style>
        .error { color: red; font-size: 14px; margin-top: 5px; }
        .alert { padding: 10px; background: lightcoral; color: white; margin-bottom: 10px; }
    </style>
</head>
<body>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="container" id="container">
    <!-- Form Đăng Ký -->
    <div class="form-container sign-up-container">
        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf
            <h1>Đăng Ký</h1>
            <input type="text" name="name" id="name" placeholder="Họ và Tên">
            <span class="error" id="nameError"></span>

            <input type="text" name="login" id="registerLogin" placeholder="Email hoặc Số điện thoại">
            <span class="error" id="registerLoginError"></span>

            <input type="password" name="password" id="registerPassword" placeholder="Mật khẩu">
            <span class="error" id="registerPasswordError"></span>

            <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Xác nhận mật khẩu">
            <span class="error" id="confirmPasswordError"></span>

            <button type="submit">Đăng Ký</button>
        </form>
    </div>

    <!-- Form Đăng Nhập -->
    <div class="form-container sign-in-container">
        <form action="{{ route('login.post') }}" method="POST" id="loginForm">
            @csrf
            <h1>Đăng Nhập</h1>
            <input type="text" name="login" id="loginEmail" placeholder="Email hoặc Số điện thoại">
            <span class="error" id="loginEmailError"></span>

            <input type="password" name="password" id="loginPassword" placeholder="Mật khẩu">
            <span class="error" id="loginPasswordError"></span>

            <button type="submit">Đăng Nhập</button>
        </form>
    </div>

    <!-- Chuyển Đổi Giữa Đăng Nhập & Đăng Ký -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Chào Mừng Trở Lại!</h1>
                <p>Để kết nối với chúng tôi, vui lòng đăng nhập</p>
                <button class="ghost" id="signIn">Đăng Nhập</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Xin Chào!</h1>
                <p>Nhập thông tin cá nhân để đăng ký</p>
                <button class="ghost" id="signUp">Đăng Ký</button>
            </div>
        </div>
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        let valid = true;

        let name = document.getElementById('name').value.trim();
        if (name !== "" && name.length < 3) {
            document.getElementById('nameError').innerText = "Tên phải có ít nhất 3 ký tự.";
            valid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        let login = document.getElementById('registerLogin').value.trim();
        if (login !== "" && !login.includes('@') && !/^\d{10,11}$/.test(login)) {
            document.getElementById('registerLoginError').innerText = "Email hoặc số điện thoại không hợp lệ.";
            valid = false;
        } else {
            document.getElementById('registerLoginError').innerText = "";
        }

        let password = document.getElementById('registerPassword').value.trim();
        if (password !== "" && password.length < 6) {
            document.getElementById('registerPasswordError').innerText = "Mật khẩu ít nhất 6 ký tự.";
            valid = false;
        } else {
            document.getElementById('registerPasswordError').innerText = "";
        }

        let confirmPassword = document.getElementById('confirmPassword').value.trim();
        if (confirmPassword !== "" && confirmPassword !== password) {
            document.getElementById('confirmPasswordError').innerText = "Mật khẩu xác nhận không khớp.";
            valid = false;
        } else {
            document.getElementById('confirmPasswordError').innerText = "";
        }

        if (!valid) e.preventDefault();
    });

    
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        let valid = true;

        let login = document.getElementById('loginEmail').value.trim();
        if (login !== "" && !login.includes('@') && !/^\d{10,11}$/.test(login)) {
            document.getElementById('loginEmailError').innerText = "Email hoặc số điện thoại không hợp lệ.";
            valid = false;
        } else {
            document.getElementById('loginEmailError').innerText = "";
        }

        let password = document.getElementById('loginPassword').value.trim();
        if (password !== "" && password.length < 6) {
            document.getElementById('loginPasswordError').innerText = "Mật khẩu ít nhất 6 ký tự.";
            valid = false;
        } else {
            document.getElementById('loginPasswordError').innerText = "";
        }

        if (!valid) e.preventDefault();
    });
</script>

</body>
</html>
