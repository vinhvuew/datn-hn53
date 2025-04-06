<header class="version_1">
    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('client')); ?>/img/logoone.png" alt=""
                                height="60" width="150px"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="#0">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        
                        <ul>
                            <li>
                                <a href="<?php echo e(route('home')); ?>" class="show-submenu">Trang chủ</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('product.show')); ?>" class="show-submenu">Sản phẩm</a>

                            </li>
                            <li>
                                <a href="<?php echo e(route('policies')); ?>">Chính sách</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('news')); ?>">Bài viết</a>
                            </li>
                            <li>
                                <?php if(Auth::check()): ?>
                                    <form action="<?php echo e(route('chat.create', Auth::user()->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-warning mx-2">Liên
                                            Hệ
                                            Admin</button>
                                    </form>
                                <?php endif; ?>

                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <form action="<?php echo e(route('search')); ?>" method="GET">
                            <input type="text" name="q" placeholder="Tìm sản phẩm..." required>
                            <button type="submit">🔍 </button>
                        </form>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">

                                <div class="dropdown-menu">
                                    <ul>
                                        <li>
                                            <a href="product-detail-1.html">
                                                <figure><img
                                                        src="<?php echo e(asset('client')); ?>/img/products/product_placeholder_square_small.jpg"
                                                        data-src="<?php echo e(asset('client')); ?>/img/products/shoes/thumb/1.jpg"
                                                        alt="" width="50" height="50" class="lazy">
                                                </figure>
                                                <strong><span>1x Armor Air x Fear</span>$90.00</strong>
                                            </a>
                                            <a href="#0" class="action"><i class="ti-trash"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-detail-1.html">
                                                <figure><img
                                                        src="<?php echo e(asset('client')); ?>/img/products/product_placeholder_square_small.jpg"
                                                        data-src="<?php echo e(asset('client')); ?>/img/products/shoes/thumb/2.jpg"
                                                        alt="" width="50" height="50" class="lazy">
                                                </figure>
                                                <strong><span>1x Armor Okwahn II</span>$110.00</strong>
                                            </a>
                                            <a href="https://ansonika.com/allaia/0" class="action"><i
                                                    class="ti-trash"></i></a>
                                        </li>
                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong>Total</strong><span>$200.00</span></div>

                                        <a href="" class="btn_1 outline">View Cart</a><a href="checkout.html"
                                            class="btn_1">Checkout</a>

                                        <a href="<?php echo e(route('cart.view')); ?>" class="btn_1 outline">View Cart</a><a
                                            href="checkout.html" class="btn_1">Checkout</a>


                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <div class="dropdown dropdown-access d-flex align-items-center">
                                <?php if(Auth::check()): ?>
                                    <i class="fa-regular fa-user fs-4"></i>
                                    <strong><?php echo e(Auth::user()->name); ?></strong>
                                    <a href="<?php echo e(route('cart.view')); ?>" class="cart_bt ms-3"></a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li>
                                                <a href="<?php echo e(route('favorites')); ?>">
                                                    <i class="fas fa-heart me-2"></i> Sản phẩm yêu thích
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(route('profile.myOder')); ?>"><i class="ti-package"></i>Đơn
                                                    hàng của
                                                    tôi</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(route('profile.index')); ?>"><i class="ti-user"></i>Hồ
                                                    sơ</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                                </a>
                                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                                    style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </li>

                                            
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login.post')); ?>"
                                        class="d-flex align-items-center text-primary text-decoration-none fs-5 fw-semibold">
                                        <i class="fas fa-user-lock me-2 fs-3"></i>
                                        <span>Sign in / Sign up</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <!-- /dropdown-access-->
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /row -->

            <!-- /main_nav -->
</header>
<!-- /header -->
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/layouts/parials/header.blade.php ENDPATH**/ ?>