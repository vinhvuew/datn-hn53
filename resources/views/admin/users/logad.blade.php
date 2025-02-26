<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/logad.css') }}">
    <style>
        .error-text {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">Đăng nhập</div>

        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.logad') }}" method="POST" class="form" id="login-form">
            @csrf

            
            <input class="input" type="text" name="login" placeholder="Email hoặc Số điện thoại" value="{{ old('login') }}">
            <span class="error-text" id="login-error"></span>
            @error('login')
                <span class="error-text">{{ $message }}</span>
            @enderror

          
            <input class="input" type="password" name="password" placeholder="Mật khẩu">
            <span class="error-text" id="password-error"></span>
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <span class="forgot-password"><a href="#">Quên mật khẩu?</a></span>

         
            <button type="submit" class="login-button" id="login-button">Đăng nhập</button>
        </form>
    </div>

    <script>
        document.getElementById("login-form").addEventListener("submit", function (event) {
            let loginInput = document.querySelector("input[name='login']");
            let passwordInput = document.querySelector("input[name='password']");
            let loginButton = document.getElementById("login-button");

            let loginError = document.getElementById("login-error");
            let passwordError = document.getElementById("password-error");

            loginError.textContent = "";
            passwordError.textContent = "";

            let valid = true;

          
            if (loginInput.value.trim() === "") {
                loginError.textContent = "Vui lòng nhập Email hoặc Số điện thoại.";
                valid = false;
            }

            if (passwordInput.value.length < 6) {
                passwordError.textContent = "Mật khẩu phải có ít nhất 6 ký tự.";
                valid = false;
            }

        
            if (!valid) {
                event.preventDefault();
                return;
            }

           
            loginButton.disabled = true;
        });
    </script>
</body>
</html>
