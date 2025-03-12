<form action="{{ route('password.verify') }}" method="POST" class="container mt-5 p-4 bg-white shadow rounded" style="max-width: 400px;" onsubmit="return validateOTP()">
    @csrf
    <h3 class="text-center text-primary mb-4">Xác Thực Mã OTP</h3>

    <div class="mb-3">
        <label for="code" class="form-label">Nhập Mã Xác Thực:</label>
        <input type="text" id="code" name="code" class="form-control text-center fw-bold" placeholder="Nhập mã 6 số..." required>
        <div id="codeError" class="text-danger mt-1"></div>
    </div>

    <button type="submit" class="btn btn-primary w-100">Xác Thực</button>
</form>

<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function validateOTP() {
    let code = document.getElementById("code").value;
    let codeError = document.getElementById("codeError");

    codeError.innerHTML = "";

    if (!/^\d{6}$/.test(code)) {
        codeError.innerHTML = "Mã xác thực phải là 6 chữ số.";
        return false;
    }

    return true;
}
</script>
