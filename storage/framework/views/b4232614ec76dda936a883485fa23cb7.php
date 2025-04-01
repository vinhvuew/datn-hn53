<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('info'); ?>" href="<?php echo e(route('profile.index')); ?>">
                    <i class='mdi mdi-account-outline me-1 mdi-20px'>
                    </i>Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('order'); ?>" href="<?php echo e(route('profile.myOder')); ?>">
                    <i class='mdi mdi mdi-cart-check mdi-20px me-1'>
                    </i>Lịch Sử Đơn hàng</a>
            </li>
            
            <li class="nav-item">
                <?php if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'moderator')): ?>
                    <a class="nav-link <?php echo $__env->yieldContent('Account'); ?>" href="<?php echo e(route('admin.logad')); ?>">
                        <i class='mdi mdi-account me-1 mdi-20px'></i> Đăng nhập Admin
                    </a>
                <?php endif; ?>

            </li>
            <li class="nav-item">
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>

                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout me-1 mdi-20px"></i> Đăng xuất
                </a>
            </li>

        </ul>
    </div>
</div>
<!--/ Navbar pills -->
<?php /**PATH /Users/admin/datn-hn53/resources/views/client/users/profile/layouts/Navbar.blade.php ENDPATH**/ ?>