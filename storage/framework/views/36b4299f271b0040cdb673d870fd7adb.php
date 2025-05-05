<?php $__env->startSection('content'); ?>
    <main>
        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Kết quả tìm kiếm</h2>
                <span>Sản phẩm phù hợp</span>
                <p> các sản phẩm bạn đang tìm kiếm.</p>
            </div>
            <div class="row small-gutters">
                <?php if($searchResults->isNotEmpty()): ?>
                    <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div
                                class="card border-0 shadow-sm rounded overflow-hidden position-relative h-100 product-card">
                                <a href="<?php echo e(route('productDetail', $product->slug)); ?>" class="d-block overflow-hidden">
                                    <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>"
                                        class="card-img-top img-fluid product-image fixed-size transition"
                                        alt="<?php echo e($product->name); ?>">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <a href="<?php echo e(route('productDetail', $product->slug)); ?>"
                                        class="text-dark text-decoration-none product-title-link">
                                        <h4 class="fw-bold product-title transition"><?php echo e(Str::limit($product->name, 20)); ?>

                                        </h4>
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
                <?php else: ?>
                    <div class="col-12 text-center">
                        <h4 class="text-danger">Sản phẩm không tồn tại</h4>
                        <p>Vui lòng thử lại bằng từ khóa khác.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>
    <!-- /main -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <style>
        .product-image {
            transition: transform 0.3s ease-in-out, opacity 0.3s;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
            opacity: 0.9;
        }

        /* Hiệu ứng hover cho tiêu đề sản phẩm */
        .product-title-link {
            transition: color 0.3s ease-in-out;
        }

        .product-title-link:hover .product-title {
            color: #4a4adf;
            /* Đổi màu chữ khi hover */
        }

        .fixed-size {
            width: 100%;
            /* Giữ chiều rộng tối đa theo card */
            height: 250px;
            /* Chiều cao cố định */
            object-fit: cover;
            /* Cắt ảnh để vừa khung mà không bị méo */
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/searchResults.blade.php ENDPATH**/ ?>