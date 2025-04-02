<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/css/pages/logad.css')); ?>">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .error-text {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            text-align: left;
        }

        /* Styling for the form */
        .container {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Styling for the 'X' button inside the form with circular background */
        .close-btn {
            position: absolute;
            top: -15px;
            right: -15px;
            font-size: 30px;
            background-color: #f0f0f0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }

        .close-btn:hover {
            background-color: #e0e0e0;
        }

        /* Hover effect for the icon */
        .close-btn i {
            color: #333;
        }

        .close-btn:hover i {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Close button using Font Awesome icon inside the form -->
        <button class="close-btn" onclick="window.location.href='/'">
            <i class="fas fa-times"></i> <!-- Font Awesome 'X' icon -->
        </button>

        <div class="heading">Đăng nhập</div>

        <?php if(session('error')): ?>
            <div class="error-message"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.logad')); ?>" method="POST" class="form" id="login-form">
            <?php echo csrf_field(); ?>

            <input class="input" type="text" name="login" placeholder="Email hoặc Số điện thoại"
                value="<?php echo e(old('login')); ?>">
            <span class="error-text" id="login-error"></span>
            <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-text"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <input class="input" type="password" name="password" placeholder="Mật khẩu">
            <span class="error-text" id="password-error"></span>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-text"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <span class="forgot-password"><a href="<?php echo e(route('password.forgot.form')); ?>">Quên mật khẩu?</a></span>

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
<?php /**PATH /Users/admin/datn-hn53/resources/views/admin/users/logad.blade.php ENDPATH**/ ?>