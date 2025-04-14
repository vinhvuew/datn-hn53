<?php $__env->startSection('content'); ?>
    <main>
        <div class="container margin_60_35">
            <div class="main_title text-center">
                <h2 class="text-uppercase">💖 Danh Sách Yêu Thích 💖</h2>
                <span>Sản phẩm bạn yêu thích</span>
                <p class="text-muted">Danh sách các sản phẩm bạn đã thêm vào mục yêu thích.</p>
            </div>

            <div class="row justify-content-center">
                <?php if($favorites->isNotEmpty()): ?>
                    <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div
                                class="card border-0 shadow-sm rounded overflow-hidden position-relative h-100 product-card">
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
                                <div class="card-footer text-center">
                                    <form action="<?php echo e(route('favorites.destroy', $product->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                                            <i class="fas fa-trash-alt"></i> Xóa khỏi yêu thích
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12 text-center mt-5">
                        <h4 class="text-danger">😢 Bạn chưa có sản phẩm yêu thích nào.</h4>
                        <p class="text-muted">Hãy thêm sản phẩm vào yêu thích để xem lại sau.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .product-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .price_box .old_price {
            text-decoration: line-through;
            color: #6c757d;
        }

        .new_price {
            color: #e74c3c;
            font-weight: bold;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
        }

        .card-footer button {
            border-color: #e74c3c;
            color: #e74c3c;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .card-footer button:hover {
            background-color: #e74c3c;
            color: white;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .product-image {
            border-radius: 5px;
        }

        .font-weight-bold {
            font-weight: 600;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/product/favorites.blade.php ENDPATH**/ ?>