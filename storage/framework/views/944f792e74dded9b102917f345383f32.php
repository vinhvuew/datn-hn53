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

        <?php if(session('message')): ?>
            <div class="alert alert-info text-center">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger text-center">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('verification.submit')); ?>" method="POST" class="mt-3">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="code" class="form-label">Nhập mã xác thực:</label>
                <input type="text" name="code" class="form-control <?php if(session('error')): ?> is-invalid <?php endif; ?>"
                    value="<?php echo e(old('code')); ?>">

                <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn btn-primary w-100">Xác nhận</button>
        </form>

        <form action="<?php echo e(route('resend.verification')); ?>" method="POST" class="mt-2">
            <?php echo csrf_field(); ?>
            <button type="submit" id="resend-btn" class="btn btn-secondary w-100"
                <?php if(session('remaining_time')): ?> disabled <?php endif; ?>>
                Gửi lại mã xác thực
            </button>
        </form>

        <?php if(session('remaining_time')): ?>
            <p class="text-danger text-center mt-2">
                Bạn có thể gửi lại mã sau <span id="countdown"><?php echo e(session('remaining_time')); ?></span> giây.
            </p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let countdownElem = document.getElementById("countdown");
        let resendBtn = document.getElementById("resend-btn");

        if (countdownElem) {
            let timeLeft = parseInt(countdownElem.textContent);
            let timer = setInterval(function () {
                if (timeLeft <= 1) {
                    clearInterval(timer);
                    countdownElem.parentElement.style.display = "none";
                    resendBtn.removeAttribute("disabled");
                } else {
                    timeLeft--;
                    countdownElem.textContent = timeLeft;
                }
            }, 1000);
        }
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/auth/verify_code.blade.php ENDPATH**/ ?>