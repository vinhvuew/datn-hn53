<?php $__env->startSection('content'); ?>

    <main>
        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Kết quả tìm kiếm</h2>
                <span>Sản phẩm phù hợp</span>
                <p>Hiển thị các sản phẩm bạn đang tìm kiếm.</p>
            </div>

            <div class="row small-gutters">
                <?php if($searchResults->isNotEmpty()): ?>
                    <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>"
                                        width="300px" alt="<?php echo e($product->name); ?>">
                                </figure>
                                <h3><?php echo e($product->name); ?></h3>
                                <div class="price_box">
                                    <span class="old_price"><?php echo e(number_format($product->base_price)); ?>đ</span>

                                    <?php if($product->price_sale): ?>
                                        <span class="new_price"><?php echo e(number_format($product->price_sale)); ?>đ</span>
                                    <?php endif; ?>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#" class="tooltip-1" data-bs-toggle="tooltip"
                                           data-bs-placement="left" title="Thêm vào so sánh">
                                           <i class="ti-control-shuffle"></i><span>So sánh</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="tooltip-1" data-bs-toggle="tooltip"
                                           data-bs-placement="left" title="Thêm vào giỏ hàng">
                                           <i class="ti-shopping-cart"></i><span>Thêm giỏ hàng</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <h4 class="text-danger">Sản phẩm không tồn tại</h4>
                        <p>Vui lòng thử lại với từ khóa khác.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>
    <!-- /main -->





<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/searchResults.blade.php ENDPATH**/ ?>