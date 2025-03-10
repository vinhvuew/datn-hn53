<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('info'); ?>" href="javascript:void(0);">
                    <i class='mdi mdi-account-outline me-1 mdi-20px'>
                    </i>Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('order'); ?>" href="pages-profile-teams.html">
                    <i class='mdi mdi mdi-cart-check mdi-20px me-1'>
                    </i>Đơn hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('History'); ?>" href="pages-profile-projects.html">
                    <i class='mdi mdi-history me-1 mdi-20px'>
                    </i>Lịch sử</a>
            </li>
            <li class="nav-item">
                    <?php if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'moderator')): ?>
                        <a class="nav-link <?php echo $__env->yieldContent('Account'); ?>" href="<?php echo e(route('admin.logad')); ?>" >
                            <i class='mdi mdi-account me-1 mdi-20px'></i> Đăng nhập Admin
                        </a>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger">
                            <i class="mdi mdi-logout"></i> Đăng xuất
                        </a>
                    </li>
                   
               
                
            </li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/users/profile/layouts/Navbar.blade.php ENDPATH**/ ?>