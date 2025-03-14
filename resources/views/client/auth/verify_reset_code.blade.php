<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực Mật khẩu</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">
        <h4 class="text-center">Xác thực Mật khẩu</h4>

        @if (session('message'))
            <div class="alert alert-info text-center">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.verify') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Nhập mã OTP:</label>
                <input type="text" name="code" id="code" class="form-control text-center fw-bold" placeholder="Nhập mã 6 số..." required>
                <div id="codeError" class="text-danger mt-1"></div>
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Xác nhận</button>
        </form>

        <form action="{{ route('password.resend') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" id="resend-btn" class="btn btn-secondary w-100" @if (session('remaining_time')) disabled @endif>
                Gửi lại mã OTP
            </button>
        </form>

        @if (session('remaining_time'))
            <p class="text-danger text-center mt-2">
                Bạn có thể gửi lại mã sau <span id="countdown">{{ session('remaining_time') }}</span> giây.
            </p>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
        });
    </script>

</body>

</html>
