<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực đặt lại mật khẩu</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card text-center shadow p-4" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="card-title">Xin chào, {{ $user->name }}</h4>
            <p class="card-text">Bạn đã yêu cầu đặt lại mật khẩu.</p>
            <p>Mã xác thực của bạn là:</p>
            <h2 class="fw-bold text-danger">{{ $user->verification_code }}</h2>
            <p>Mã này sẽ hết hạn sau <strong>5 phút</strong>.</p>
            <p class="mt-3">Vui lòng nhập mã này vào trang xác thực để đặt lại mật khẩu.</p>
            <a href="{{ route('password.reset.form') }}" class="btn btn-danger mt-3">Đặt lại mật khẩu</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
