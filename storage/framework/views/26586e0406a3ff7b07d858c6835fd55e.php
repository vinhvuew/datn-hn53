<?php $__env->startSection('info', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <div class="content-wrapper" style="padding: 1px 0 250px;">
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="user-profile-header-banner">
                                <img src="<?php echo e(asset('admin')); ?>/assets/img/pages/profile-banner.png" alt="Banner image"
                                    class="rounded-top">
                            </div>
                            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-4">
                                
                                <form action="<?php echo e(route('profile.updateAvatar')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <div class="position-relative d-inline-block">
                                        <img src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>" alt="user image"
                                            class="d-block rounded-circle user-profile-img"
                                            style="width: 100px; height: 100px; object-fit: cover;">


                                        <label for="avatar-upload"
                                            class="position-absolute bottom-0 end-0 bg-white p-1 rounded-circle shadow"
                                            style="cursor: pointer;">
                                            <i class="fas fa-camera text-primary"></i>
                                        </label>
                                        <input type="file" id="avatar-upload" name="avatar" class="d-none"
                                            onchange="this.form.submit()">
                                    </div>
                                </form>

                                <div class="flex-grow-1 mt-3 mt-lg-5">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4><?php echo e(Auth::user()->name); ?></h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-invert-colors me-1 mdi-20px'></i>
                                                    <?php switch(Auth::user()->role):
                                                        case ('user'): ?>
                                                            Thành viên
                                                        <?php break; ?>

                                                        <?php case ('admin'): ?>
                                                            Quản trị
                                                        <?php break; ?>

                                                        <?php case ('moderator'): ?>
                                                            Nhân viên
                                                        <?php break; ?>

                                                        <?php default: ?>
                                                            Không xác định
                                                    <?php endswitch; ?>
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-map-marker-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Việt Nam</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-calendar-blank-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Tham gia:
                                                        <?php echo e(Auth::user()->created_at->format('d/m/Y')); ?>

                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-warning text-dark fw-bold">
                                            <i class='mdi mdi-account-check-outline me-1'></i>Đã kết nối
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Header -->

                <?php echo $__env->make('client.users.profile.layouts.Navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- User Profile Content -->
                <div class="row">
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <!-- Activity Timeline -->
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-chart-timeline-variant mdi-24px me-2'></i>cập nhật thông tin</h5>
                            </div>
                            <div class="card-body pt-3 pb-0">
                                <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="<?php echo e(Auth::user()->name); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="<?php echo e(Auth::user()->phone); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?php echo e(Auth::user()->address); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?php echo e(Auth::user()->email); ?>">
                                    </div>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!--/ Activity Timeline -->
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <?php if(session('successp')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('successp')); ?>

                            </div>
                        <?php endif; ?>
                            
                        <!-- About User -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">Thay đổi mật khẩu</h5>
                                </div>
                                <form action="<?php echo e(route('profile.updatePassword')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3 position-relative">
                                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('current_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label for="new_password" class="form-label">Mật khẩu mới</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('new_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="new_password_confirmation">
                                            <span class="input-group-text toggle-password"
                                                onclick="togglePassword('confirm_password')">
                                                <i class="mdi mdi-eye-off-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ About User -->
                    </div>

                </div>
                <!--/ User Profile Content -->
            </div>
        </div>
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/pages/page-profile.css" />
    <style>
        a {
            color: #4C5671;
        }

        .rts-header__menu ul li a {
            color: #000000;
        }

        .rts-header__right .login__btn {
            border: 1px solid #000000;
            color: #000000;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #9055fd;
            color: #fff;
        }
    </style>
<?php $__env->stopSection(); ?>
<script>
    function togglePassword(fieldId) {
        let field = document.getElementById(fieldId);
        let icon = field.nextElementSibling.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("mdi-eye-off-outline");
            icon.classList.add("mdi-eye-outline");
        } else {
            field.type = "password";
            icon.classList.remove("mdi-eye-outline");
            icon.classList.add("mdi-eye-off-outline");
        }
    }
</script>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/users/profile/edit.blade.php ENDPATH**/ ?>