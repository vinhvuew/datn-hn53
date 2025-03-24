<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg">
        <?php if($news->image): ?>
        <img src="<?php echo e(Storage::url($news->image)); ?>" class="card-img-top"  width="40px" height="auto">

        <?php endif; ?>
        <div class="card-body">
            <h1 class="card-title"><?php echo e($news->title); ?></h1>
            <p class="text-muted">
                Ngày đăng: <?php echo e($news->created_at ? $news->created_at->format('d/m/Y H:i') : 'Không có thông tin'); ?>

            </p>
            <p class="card-text"><?php echo e($news->content); ?></p>
            <a href="<?php echo e(url('/news')); ?>" class="btn btn-secondary mt-3">Quay lại</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/news/show.blade.php ENDPATH**/ ?>