<form action="{{ route('password.forgot') }}" method="POST" class="container mt-5 p-4 bg-white shadow rounded" style="max-width: 400px;" onsubmit="return validateEmail()">
    @csrf
    <h3 class="text-center text-primary mb-4">Quên Mật Khẩu</h3>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn..." value="{{ old('email') }}">
        
        @if ($errors->has('email'))
            <div class="text-danger mt-1">
                @foreach ($errors->get('email') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

       
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
