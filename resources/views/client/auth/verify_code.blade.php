<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực tài khoản</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">
        <h4 class="text-center">Xác thực tài khoản</h4>

        <!-- Thông báo -->
        @if(session('message'))
            <div class="alert alert-info text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- Form nhập mã xác thực -->
        <form action="{{ route('verification.submit') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Nhập mã xác thực:</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Xác nhận</button>
        </form>

        <!-- Form gửi lại mã -->
        <form action="{{ route('resend.verification') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-secondary w-100">Gửi lại mã xác thực</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
