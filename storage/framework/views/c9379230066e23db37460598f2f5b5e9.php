<form action="<?php echo e(route('password.reset')); ?>" method="POST" class="container mt-5 p-4 bg-white shadow rounded" style="max-width: 400px;" onsubmit="return validateForm()"> 
    <?php echo csrf_field(); ?>
    <h3 class="text-center text-primary mb-4">Đặt Lại Mật Khẩu</h3>

    <!-- Mật khẩu mới -->
    <div class="mb-3 position-relative">
        <label for="password" class="form-label">Mật khẩu mới:</label>
        <div class="input-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới..." required>
            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', 'togglePasswordIcon1')">
                <i id="togglePasswordIcon1" class="bi bi-eye"></i>
            </button>
        </div>
        <div id="passwordError" class="text-danger mt-1"></div>
    </div>

    <!-- Nhập lại mật khẩu -->
    <div class="mb-3 position-relative">
        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu:</label>
        <div class="input-group">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu..." required>
            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation', 'togglePasswordIcon2')">
                <i id="togglePasswordIcon2" class="bi bi-eye"></i>
            </button>
        </div>
        <div id="confirmError" class="text-danger mt-1"></div>
    </div>

    <button type="submit" class="btn btn-primary w-100">Đặt Lại Mật Khẩu</button>
</form>

<!-- Bootstrap 5 & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function validateForm() {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirmation").value;
    let passwordError = document.getElementById("passwordError");
    let confirmError = document.getElementById("confirmError");
    
    passwordError.innerHTML = "";
    confirmError.innerHTML = "";

    if (password.length < 6) {
        passwordError.innerHTML = "Mật khẩu phải có ít nhất 6 ký tự.";
        return false;
    }

    if (password !== confirmPassword) {
        confirmError.innerHTML = "Mật khẩu nhập lại không khớp.";
        return false;
    }

    return true;
}

// Hàm ẩn/hiện mật khẩu
function togglePassword(inputId, iconId) {
    let input = document.getElementById(inputId);
    let icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/auth/reset_password.blade.php ENDPATH**/ ?>