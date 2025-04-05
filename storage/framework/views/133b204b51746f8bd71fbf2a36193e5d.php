<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="logo">
        <img src="<?php echo e(asset('images/logo.jpg')); ?>" height="150px" width="250px" alt="">
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?php echo $__env->yieldContent('item-dashboards'); ?>">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Dashboards">
                    Dashboards
                </div>
                <span class="badge badge-center rounded-pill bg-danger ms-auto">5</span>
            </a>
        </li>
        <li class="menu-item <?php echo $__env->yieldContent('item-order'); ?>">
            <a href="<?php echo e(route('orders.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div class="text-truncate" data-i18n="Đơn hàng">
                    Đơn hàng
                </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('admin.chat.index')); ?>" class="menu-link">
                <i class="menu-icon fa-solid fa-message"></i>

                <div class="text-truncate" data-i18n="CHAT">CHAT</div>
            </a>
        </li>
        
        <li class="menu-item <?php echo $__env->yieldContent('item-category'); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-folder-open"></i>
                <div class="text-truncate" data-i18n="Danh Mục">Danh Mục</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item <?php echo $__env->yieldContent('item-category-create'); ?>">
                    <a href="<?php echo e(route('category.create')); ?>" class="menu-link">

                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới`
                        </div>
                    </a>
                </li>

                <li class="menu-item <?php echo $__env->yieldContent('item-category-index'); ?>">
                    <a href="<?php echo e(route('category.index')); ?>" class="menu-link">

                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="menu-item <?php echo $__env->yieldContent('item-brand'); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div class="text-truncate" data-i18n="Thương thiệu">Thương hiệu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $__env->yieldContent('item-brand-create'); ?>">
                    <a href="<?php echo e(route('brands.create')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới
                        </div>
                    </a>
                </li>
                <li class="menu-item <?php echo $__env->yieldContent('item-brand-index'); ?>">
                    <a href="<?php echo e(route('brands.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="menu-item <?php echo $__env->yieldContent('item-product'); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Sản phẩm">Sản phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $__env->yieldContent('item-product-create'); ?>">
                    <a href="<?php echo e(route('products.create')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm sản phẩm">Thêm sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $__env->yieldContent('item-product-index'); ?>">
                    <a href="<?php echo e(route('products.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh sách sản phẩm">Danh sách sản phẩm</div>
                    </a>
                </li>

            </ul>
        </li>
        
        <li class="menu-item  <?php echo $__env->yieldContent('item-atribute'); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Thuộc tính">Thuộc tính</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $__env->yieldContent('item-atribute-add'); ?>">
                    <a href="<?php echo e(route('attributes.create')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm thuộc tính">Thêm thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $__env->yieldContent('item-atribute-index'); ?>">
                    <a href="<?php echo e(route('attributes.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh sách thuộc tính">Danh sách thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $__env->yieldContent('item-atribute-value'); ?>">
                    <a href="<?php echo e(route('attribute-values.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Giá trị thuộc tính">Giá trị thuộc tính</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div class="text-truncate" data-i18n="Voucher">
                    Voucher
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo e(route('vouchers.index')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="danh sach">
                            Danh sách
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('vouchers.create')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="them">
                            Thêm
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item <?php echo $__env->yieldContent('item-user'); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Tài Khoản">Tài Khoản</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $__env->yieldContent('user-index'); ?>">
                    <a href="<?php echo e(route('users.index')); ?>" class="menu-link">
                        <div data-i18n="Khách hàng">Khách hàng</div>
                    </a>
                </li>

                <?php if(auth()->user()->role_id == 1): ?>
                    
                    <li class="menu-item <?php echo $__env->yieldContent('user-role'); ?>">
                        <a href="<?php echo e(route('roles.index')); ?>" class="menu-link">
                            <div data-i18n="Vai Trò">Vai Trò</div>
                        </a>
                    </li>
                <?php endif; ?>

                
                
                
                
                
                
                
            </ul>
        </li>


        <li class="menu-item">
            <a href="<?php echo e(route('comment.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chart"></i>
                <div class="text-truncate" data-i18n="Bình luận">Bình luận</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class=" menu-icon fa-sharp fa-solid fa-chart-simple"></i>
                <div class="text-truncate" data-i18n="Thống kê">
                    Thống kê
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo e(route('thongke.statistical')); ?>" class="menu-link">
                        <div class="text-truncate" data-i18n=" Doanh thu">
                            Doanh thu
                        </div>
                    </a>
                </li>

            </ul>
        </li>


        <li class="menu-item">
            <a href="<?php echo e(route('news.index')); ?>" class="menu-link">
                <i class="menu-icon fa-regular fa-newspaper"></i>
                
                <div class="text-truncate" data-i18n="Tin Tức">Tin Tức</div>
            </a>
        </li>



    </ul>
</aside>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/layouts/parials/menu.blade.php ENDPATH**/ ?>