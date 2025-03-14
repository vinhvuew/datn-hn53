<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
        </h2>
        <a href="<?php echo e(route('news.create')); ?>" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle"></i> Thêm Tin Tức
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $listNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="<?php echo e($news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/300'); ?>"
                         class="card-img-top rounded-top" height="200" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo e($news->title); ?></h5>
                        <p class="card-text"><?php echo e(Str::limit(strip_tags($news->content), 100)); ?></p>
                        <p class="text-muted small">Ngày tạo: <?php echo e(optional($news->created_at)->format('d/m/Y H:i')); ?></p>
                        <div class="d-flex justify-content-between">
                            
                            <form action="<?php echo e(route('news.destroy', $news->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Xác nhận xóa tin này?')">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
<style>
    .rounded-4 { border-radius: 1rem !important; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/news/index.blade.php ENDPATH**/ ?>