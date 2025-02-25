
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/logad.css') }}">
</head>

<body>
    <div class="container">
        <div class="heading">Đăng nhập</div>

        
        @if (session('error'))
            <div style="color:red; text-align:center;">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.logad') }}" method="POST" class="form">
            @csrf
           
            <input required class="input" type="text" name="login" placeholder="Email hoặc Số điện thoại">
            @error('login')
                <div style="color:red; font-size:12px;">{{ $message }}</div>
            @enderror

            <input required class="input" type="password" name="password" placeholder="Mật khẩu">
            @error('password')
                <div style="color:red; font-size:12px;">{{ $message }}</div>
            @enderror

            <span class="forgot-password"><a href="#">Quên mật khẩu ?</a></span>
            <input class="login-button" type="submit" value="Đăng nhập">
        </form>
    </div>
</body>

</html>
