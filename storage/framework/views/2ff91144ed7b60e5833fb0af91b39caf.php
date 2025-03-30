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

    <div class="card text-center shadow p-4" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="card-title">Chào <?php echo e($user->name); ?>,</h4>
            <p class="card-text">Mã xác thực của bạn là:</p>
            <h2 class="fw-bold text-primary"><?php echo e($user->verification_code); ?></h2>
            <p>Mã này sẽ hết hạn sau 5 phút.</p>
            <p class="mt-3">Vui lòng nhập mã này vào trang xác thực để kích hoạt tài khoản.</p>
            <a href="<?php echo e(route('verification.form')); ?>" class="btn btn-primary mt-3">Nhập mã xác thực</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /Users/admin/datn-hn53/resources/views/client/emails/verify_email.blade.php ENDPATH**/ ?>