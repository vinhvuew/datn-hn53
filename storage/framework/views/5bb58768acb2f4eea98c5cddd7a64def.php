<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-gradient fw-bold">
            <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
        </h2>
        <a href="<?php echo e(route('news.create')); ?>" class="btn btn-success shadow-lg px-4 py-2 btn-hover">
            <i class="fas fa-plus-circle"></i> Thêm Tin Tức
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $listNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg border-0 rounded-4 card-hover">
                    <img src="<?php echo e($news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/300'); ?>"
                         class="card-img-top rounded-top-4 img-hover" height="200" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo e($news->title); ?></h5>
                        <p class="card-text text-muted"><?php echo e(Str::limit(strip_tags($news->content), 100)); ?></p>
                        <div class="text-muted small">
                            📅 Ngày tạo: <strong><?php echo e(optional($news->created_at)->format('d/m/Y H:i')); ?></strong> <br>
                            ✏️ Ngày sửa: <strong><?php echo e(optional($news->updated_at)->format('d/m/Y H:i')); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="<?php echo e(route('news.show', $news->id)); ?>" class="btn btn-info btn-sm px-3 btn-hover">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="<?php echo e(route('news.edit', $news->id)); ?>" class="btn btn-warning btn-sm px-3 btn-hover">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="<?php echo e(route('news.destroy', $news->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm px-3 btn-hover"
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
    /* Gradient text đẹp hơn */
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Hiệu ứng hover cho card */
    .card-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Hiệu ứng hover cho ảnh */
    .img-hover {
        transition: transform 0.3s ease-in-out;
    }
    .img-hover:hover {
        transform: scale(1.05);
    }

    /* Hiệu ứng hover cho button */
    .btn-hover {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .btn-hover:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 12px rgba(0, 123, 255, 0.5);
    }

    /* Hiệu ứng thông báo */
    .custom-alert {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Bo góc card */
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/admin/news/index.blade.php ENDPATH**/ ?>