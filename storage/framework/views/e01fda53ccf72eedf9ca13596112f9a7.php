<?php $__env->startSection('content'); ?>
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                <div class="owl-slide cover"
                    style="background-image: url(<?php echo e(asset('client')); ?>/img/slides/slide_home_1.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-end white">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage
                                            Low</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Limited items available at this price
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover"
                    style="background-image: url(<?php echo e(asset('client')); ?>/img/slides/slide_home_2.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>VaporMax Flyknit 3</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Limited items available at this price
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover"
                    style="background-image: url(<?php echo e(asset('client')); ?>/img/slides/slide_home_3.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center black">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Monarch IV SE
                                        </h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Lightweight cushioning and durable support with a Phylon midsole
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/owl-slide-->
                </div>
            </div>
            <div id="icon_drag_mobile"></div>
        </div>

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản Phẩm Nổi Bật</h2>
                <span>Sản Phẩm Nổi Bật</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-4">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded overflow-hidden position-relative h-100 product-card">
                            <a href="<?php echo e(route('productDetail', $product->slug)); ?>" class="d-block">
                                <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>"
                                    class="card-img-top img-fluid product-image" alt="<?php echo e($product->name); ?>">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <a href="<?php echo e(route('productDetail', $product->slug)); ?>"
                                    class="text-dark text-decoration-none">
                                    <h4 class="fw-bold product-title"><?php echo e(Str::limit($product->name, 20)); ?></h4>
                                </a>
                                <p class="small text-muted flex-grow-1"><?php echo e(Str::limit($product->description, 50)); ?></p>
                                <div class="price_box mt-auto">
                                    <?php if($product->price_sale && $product->price_sale < $product->base_price): ?>
                                        <span class="old_price text-muted text-decoration-line-through">
                                            <?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND
                                        </span>
                                        <span class="new_price text-danger fw-bold">
                                            <?php echo e(number_format($product->price_sale, 0, ',', '.')); ?> VND
                                        </span>
                                    <?php else: ?>
                                        <span class="new_price text-danger fw-bold">
                                            <?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- /container -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>SẢN PHẨM GIÁ TỐT</h2>
                <span>SẢN PHẨM GIÁ TỐT</span>

            </div>
            <div class="carousel-inner">
                <?php $__currentLoopData = $goodDeals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?>">
                        <div class="row justify-content-center">
                            <div class="col-md-8"> <!-- Thay đổi từ col-md-4 thành col-md-8 để rộng hơn -->
                                <div class="grid_item" style="width: 100%; margin: 0 auto;">
                                    <figure>
                                        <a href="<?php echo e(route('productDetail', $product->slug)); ?>">
                                            <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>" width="100%"
                                                height="350"
                                                style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); object-fit: cover;"
                                                alt="Product Image">
                                        </a>
                                    </figure>
                                    <h3><a href="<?php echo e(route('productDetail', $product->slug)); ?>"><?php echo e($product->name); ?></a>
                                    </h3>
                                    <div class="price_box">
                                        <span class="new_price"><?php echo e(number_format($product->price_sale, 0, ',', '.')); ?>

                                            VND</span>
                                        <span class="old_price text-muted text-decoration-line-through">
                                            <?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- /featured -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>SẢN PHẨM MỚI</h2>
                <span>SẢN PHẨM MỚI</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-4">
                <?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card product-card border-0 shadow-sm rounded overflow-hidden position-relative h-100">
                            <a href="<?php echo e(route('productDetail', $product->slug)); ?>" class="d-block">
                                <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>"
                                    class="card-img-top img-fluid product-image" alt="<?php echo e($product->name); ?>">
                            </a>
                            <div class="card-body d-flex flex-column text-center">
                                <a href="<?php echo e(route('productDetail', $product->slug)); ?>"
                                    class="text-dark text-decoration-none">
                                    <h6 class="fw-bold product-title"><?php echo e($product->name); ?></h6>
                                </a>
                                <p class="small text-muted flex-grow-1">
                                    <?php echo e(Str::limit($product->description, 50)); ?>

                                </p>
                                <div class="price_box mt-auto">
                                    <span class="old_price text-muted text-decoration-line-through">
                                        <?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND
                                    </span>
                                    <?php if($product->price_sale): ?>
                                        <span class="new_price text-danger fw-bold">
                                            <?php echo e(number_format($product->price_sale, 0, ',', '.')); ?> VND
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- /container -->

        <div class="bg_gray">
            <div class="container margin_30">
                <div id="brands" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="#0"><img src="<?php echo e(asset('client')); ?>/img/brands/placeholder_brands.png"
                                data-src="<?php echo e(asset('client')); ?>/img/brands/logo_1.png" alt="" class="owl-lazy"></a>
                    </div>

                </div>
                <!-- /carousel -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->
        <!-- /container -->
    </main>
    <!-- /main -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <!-- /row -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Đảm bảo tất cả ảnh sản phẩm có kích thước đồng đều */
        .product-card {
            overflow: hidden;
            /* Ngăn ảnh phóng to vượt ra ngoài */
            position: relative;
        }

        /* Ảnh sản phẩm ban đầu */
        .product-image {
            width: 100%;
            height: 250px;
            /* Điều chỉnh chiều cao theo mong muốn */
            object-fit: cover;
            /* Giữ tỷ lệ ảnh */
            transition: transform 0.4s ease-in-out;
            /* Tạo hiệu ứng mượt */
        }

        /* Khi hover vào card, ảnh sẽ phóng to */
        .card:hover .product-image {
            transform: scale(1.1);
            /* Zoom 10% */
        }



        .carousel {
            position: relative;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            transition: transform 1s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            display: none;
        }

        .carousel-item.active {
            display: block;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }
    </style>
    
    <style>
        /* Áp dụng font chữ đẹp */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hiệu ứng hover cho sản phẩm */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Hiệu ứng hover cho ảnh sản phẩm */
        .product-image {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* Hiệu ứng hover cho nút hành động */
        .action-btn {
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        /* Cải thiện typography */
        .product-title {
            font-size: 16px;
            font-weight: 700;
        }

        .price_box {
            font-size: 14px;
        }

        .old_price {
            color: #888;
            font-weight: 400;
        }

        .new_price {
            font-size: 18px;
            font-weight: 700;
            color: #e63946;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll(".carousel-item");
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove("active");
                if (i === index) {
                    slide.classList.add("active");
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }


        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
        }

        // Tự động chạy slide mỗi 3 giây
        setInterval(nextSlide, 3000);

        // Hiển thị slide đầu tiên
        showSlide(currentIndex);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/Client/home.blade.php ENDPATH**/ ?>