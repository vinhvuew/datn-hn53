<form action="<?php echo e(route('password.forgot')); ?>" method="POST" class="container mt-5 p-4 bg-white shadow rounded" style="max-width: 400px;" onsubmit="return validateEmail()">
    <?php echo csrf_field(); ?>
    <h3 class="text-center text-primary mb-4">Quên Mật Khẩu</h3>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn..." value="<?php echo e(old('email')); ?>">
        
        <?php if($errors->has('email')): ?>
            <div class="text-danger mt-1">
                <?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

       
        <div id="emailError" class="text-danger mt-1"></div>
    </div>

    <button type="submit" class="btn btn-primary w-100">Gửi Mã Xác Thực</button>
</form>

<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function validateEmail() {
    let email = document.getElementById("email").value;
    let emailError = document.getElementById("emailError");

    emailError.innerHTML = "";  // Reset error message

    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailRegex.test(email)) {
        emailError.innerHTML = "Vui lòng nhập email hợp lệ.";
        return false;
    }

    return true;
}
</script>
<?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/auth/forgot_password.blade.php ENDPATH**/ ?>