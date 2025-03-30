<?php $__env->startSection('content'); ?>
    <main>
        <!-- Banner -->
        <div class="top_banner mb-5">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li class="active">Shoes</li>
                        </ul>
                    </div>
                    <h1 class="text-white">Shoes - Grid Listing</h1>
                </div>
            </div>
            <img src="<?php echo e(asset('client/img/bg_cat_shoes.jpg')); ?>" class="img-fluid w-100" alt="Banner Shoes">
        </div>
        <!-- /Banner -->

        <div class="container mt-2 pt-2">
            <div class="row">
                <!-- Bộ lọc (20%) -->
                <div class="col-lg-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h6 class="mb-0">Tìm Kiếm Sản Phẩm</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('products.filter')); ?>" method="GET">
                                <!-- Danh mục -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Danh mục</strong></label>
                                    <select class="form-select" name="category">
                                        <option value="">Chọn danh mục</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" 
                                                <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Hãng -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Hãng</strong></label>
                                    <select class="form-select" name="brand">
                                        <option value="">Chọn hãng</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->id); ?>" 
                                                <?php echo e(request('brand') == $brand->id ? 'selected' : ''); ?>>
                                                <?php echo e($brand->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Nút lọc -->
                                <button type="submit" class="btn btn-primary w-100 mt-3">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm (70%) -->
                <div class="col-lg-9">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3 mt-4">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col">
                                <div class="card border-0 shadow-sm text-center h-100">
                                    <div class="position-relative overflow-hidden">
                                        <a href="<?php echo e(route('productDetail', $product->slug)); ?>" class="d-block">
                                            <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>" 
                                                 class="img-fluid product-image" 
                                                 alt="<?php echo e($product->name); ?>">
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-decoration-none">
                                            <h5 class="card-title text-truncate"><?php echo e($product->name); ?></h5>
                                        </a>
                                        <div class="price_box">
                                            <?php if($product->price_sale): ?>
                                                <span class="new_price text-danger fw-bold">
<<<<<<< HEAD
                                                    <?php echo e(number_format($product->price_sale, 0, ',', '.')); ?>VND
                                                </span>
                                                <span class="old_price text-muted text-decoration-line-through ms-2">
                                                    <?php echo e(number_format($product->base_price, 0, ',', '.')); ?>VND
                                                </span>
                                            <?php else: ?>
                                                <span class="new_price fw-bold">
                                                    <?php echo e(number_format($product->base_price, 0, ',', '.')); ?>VND
=======
                                                    <?php echo e(number_format($product->price_sale, 0, ',', '.')); ?>đ
                                                </span>
                                                <span class="old_price text-muted text-decoration-line-through ms-2">
                                                    <?php echo e(number_format($product->base_price, 0, ',', '.')); ?>đ
                                                </span>
                                            <?php else: ?>
                                                <span class="new_price fw-bold">
                                                    <?php echo e(number_format($product->base_price, 0, ',', '.')); ?>đ
>>>>>>> f68c24408cd8fe2298b3c9489bd54a48773a5d7a
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Phân trang -->
                    <div class="pagination__wrapper d-flex justify-content-center mt-4">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <!-- CSS tùy chỉnh -->
    <style>
        .product-image {
            width: 100%; /* Chiều rộng full */
            height: 220px; /* Chiều cao cố định */
            object-fit: cover; /* Giữ tỷ lệ, cắt phần thừa */
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
        }

        .product-image:hover {
            transform: scale(1.1); /* Phóng to khi hover */
        }

        .price_box {
            font-size: 1.1rem;
        }

        .new_price {
            font-weight: bold;
            color: #dc3545;
        }

        .old_price {
            font-size: 0.9rem;
            color: gray;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
        }

        .breadcrumb li {
            margin-right: 5px;
        }

        .breadcrumb li a {
            color: #fff;
            text-decoration: none;
        }

        .breadcrumb .active {
            color: #ffc107;
        }
        span.relative.z-0.inline-flex {
    display: none !important;
}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <!-- JavaScript để cập nhật giá trị range slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            if (priceRange && priceValue) {
                priceRange.addEventListener('input', function() {
                    priceValue.textContent = this.value + 'VNĐ';
                });
                priceValue.textContent = priceRange.value + 'VNĐ';
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/product/products.blade.php ENDPATH**/ ?>