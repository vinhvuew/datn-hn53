@extends('client.layouts.master')

@section('content')
<!-- Lớp phủ mờ -->
<div class="overlay"></div>

<!-- Khu vực Đăng nhập & Đăng ký -->
<div class="auth-container">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card p-3">
          <!-- Tab -->
          <ul class="nav nav-tabs mb-4" id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                      type="button" role="tab" aria-controls="login" aria-selected="true">
                Đăng Nhập
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                      type="button" role="tab" aria-controls="register" aria-selected="false">
                Đăng Ký
              </button>
            </li>
          </ul>

          <!-- Nội dung Tab -->
          <div class="tab-content" id="authTabContent">
            <!-- Tab Đăng Nhập -->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
              <h4 class="mb-4 text-center">Đăng Nhập</h4>

              @if ($errors->any() && session('auth_type') === 'login')
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                  @endforeach
                </div>
              @endif

              <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="login_input" class="form-label">Email hoặc SĐT</label>
                  <input type="text" class="form-control" id="login_input" name="login" required>
                </div>
                <div class="mb-3">
                  <label for="login_password" class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" id="login_password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
              </form>
            </div>

            <!-- Tab Đăng Ký -->
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
              <h4 class="mb-4 text-center">Đăng Ký</h4>

              @if ($errors->any() && session('auth_type') === 'register')
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                  @endforeach
                </div>
              @endif

              <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="register_name" class="form-label">Họ và Tên</label>
                  <input type="text" class="form-control" id="register_name" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="register_login" class="form-label">Email hoặc SĐT</label>
                  <input type="text" class="form-control" id="register_login" name="login" required>
                </div>
                <div class="mb-3">
                  <label for="register_password" class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" id="register_password" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="register_password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                  <input type="password" class="form-control" id="register_password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng Ký</button>
              </form>
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Nếu session('auth_type') == 'register', hiển thị tab đăng ký
  @if(session('auth_type') === 'register')
    let registerTab = new bootstrap.Tab(document.querySelector('#register-tab'));
    registerTab.show();
  @elseif(session('auth_type') === 'login')
    let loginTab = new bootstrap.Tab(document.querySelector('#login-tab'));
    loginTab.show();
  @endif
</script>
@endsection
