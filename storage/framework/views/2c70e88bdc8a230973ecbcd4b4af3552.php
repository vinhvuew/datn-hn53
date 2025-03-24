<?php $__env->startSection('content'); ?>
<main>

<div class="container mt-4">
    <h1 class="text-center mb-4">Danh Sách Tin Tức</h1>

    <div class="row">
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <?php if($item->image): ?>
                            <div class="col-md-4">
                                <img src="<?php echo e(Storage::url($item->image)); ?>" width="400px" alt="vip">


                            </div>
                        <?php endif; ?>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?php echo e(route('news.shows', $item->id)); ?>" class="text-decoration-none text-dark">
                                        <?php echo e($item->title); ?>

                                    </a>
                                </h5>
                                <p class="text-muted">
                                    Ngày đăng: <?php echo e($item->created_at ? $item->created_at->format('d/m/Y H:i') : 'Không có thông tin'); ?>

                                </p>
                                <a href="<?php echo e(route('news.shows', $item->id)); ?>" class="btn btn-primary btn-sm">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/news/index.blade.php ENDPATH**/ ?>