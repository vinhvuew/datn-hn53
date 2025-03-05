<?php $__env->startSection('content'); ?>
    <main>
        <!-- Banner -->
        <div class="top_banner mb-5">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li>Page active</li>
                        </ul>
                    </div>
                    <h1>Shoes - Grid Listing</h1>
                </div>
            </div>
            <img src="client/img/bg_cat_shoes.jpg" class="img-fluid w-100" alt="">
        </div>
        <!-- /Banner -->

        <div class="container mt-2 pt-2">
            <div class="row">
                <!-- Bộ lọc (20%) -->
                <div class="col-lg-3" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
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
                                                <?php echo e($category->name); ?></option>
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
                                                <?php echo e(request('brand') == $brand->id ? 'selected' : ''); ?>><?php echo e($brand->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Giá sale -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Khoảng giá</strong></label>
                                    <input type="range" class="form-range" name="price_sale" id="priceRange"
                                        min="0" max="10000" step="100" value="<?php echo e(request('price_sale', 0)); ?>">
                                    <div class="d-flex justify-content-between">
                                        <span>0đ</span>
                                        <span id="priceValue"><?php echo e(request('price_sale', 0)); ?>đ</span>
                                        <!-- Hiển thị giá trị hiện tại -->
                                    </div>
                                </div>

                                <!-- Nút lọc -->
                                <button type="submit" class="btn btn-primary w-100 mt-3">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm (70%) -->
                <div class="col-lg-9">
                    <!-- Dòng chữ chạy "Sale ngập trời" -->
                    <div class="marquee bg-warning py-2 mb-4">
                        <marquee behavior="scroll" direction="left" scrollamount="10">
                            <strong class="text-danger">🎉 SALE NGẬP TRỜI - GIẢM GIÁ LÊN ĐẾN 50% 🎉</strong>
                        </marquee>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div class="row small-gutters">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="grid_item">
                                    <figure>
                                        <?php if($product->price_sale): ?>
                                            <span
                                                class="ribbon off">-<?php echo e(round((($product->price_sale - $product->base_price) / $product->price_sale) * 100)); ?>%</span>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('product.show', $product->slug)); ?>">
                                            <img class="img-fluid lazy"
                                                src="<?php echo e(asset('storage/' . $product->img_thumbnail)); ?>"
                                                alt="<?php echo e($product->name); ?>" width="400" height="400">
                                        </a>
                                    </figure>
                                    <div class="rating">
                                        <i class="icon-star voted"></i>
                                        <i class="icon-star voted"></i>
                                        <i class="icon-star voted"></i>
                                        <i class="icon-star voted"></i>
                                        <i class="icon-star"></i>
                                    </div>
                                    <a href="<?php echo e(route('product.show', $product->slug)); ?>">
                                        <h3><?php echo e($product->name); ?></h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price"><?php echo e($product->base_price); ?>đ</span>
                                        <?php if($product->price_sale): ?>
                                            <span class="old_price"><?php echo e($product->price_sale); ?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <ul>
                                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Add to compare"><i
                                                    class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Add to cart"><i
                                                    class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                    </ul>
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
    <!-- CSS cho dòng chữ chạy -->
    <style>
        .marquee {
            background-color: #ffc107;
            /* Màu nền vàng */
            padding: 10px 0;
            border-radius: 5px;
            overflow: hidden;
        }

        .marquee strong {
            font-size: 1.2rem;
            color: #dc3545;
            /* Màu chữ đỏ */
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <!-- JavaScript để cập nhật giá trị range slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            priceRange.addEventListener('input', function() {
                priceValue.textContent = this.value + 'đ';
            });

            priceValue.textContent = priceRange.value + 'đ';
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/product/products.blade.php ENDPATH**/ ?>