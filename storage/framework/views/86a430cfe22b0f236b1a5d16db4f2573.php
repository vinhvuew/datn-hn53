<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <?php if($news->image): ?>
            <img src="<?php echo e(asset('storage/' . $news->image)); ?>" class="card-img-top img-fluid rounded-top-4" alt="Hình ảnh bài viết">
        <?php endif; ?>
        <div class="card-body">
            <h1 class="card-title text-gradient fw-bold"><?php echo e($news->title); ?></h1>
            <p class="text-muted">
                📅 Ngày đăng: <strong><?php echo e(optional($news->created_at)->format('d/m/Y H:i')); ?></strong>
            </p>
            <hr>
            <p class="card-text fs-5 text-dark"><?php echo e($news->content); ?></p>
            <a href="<?php echo e(route('news.index')); ?>" class="btn btn-secondary mt-3 btn-hover">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/news/show.blade.php ENDPATH**/ ?>