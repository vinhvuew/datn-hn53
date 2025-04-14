<?php $__env->startSection('content'); ?>
    <main>

        <div class="container mt-5">
            <h1 class="text-center mb-4 text-primary fw-bold">Danh Sách Tin Tức</h1>
            <div class="row">
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 overflow-hidden h-100">
                            <a href="<?php echo e(route('news.shows', $item->id)); ?>" class="text-decoration-none">
                                <?php if($item->image): ?>
                                    <img src="<?php echo e(Storage::url($item->image)); ?>" class="card-img-top img-fluid" alt="vip">
                                <?php endif; ?>
                                <div class="card-body text-center">
                                    <h6 class="card-title text-dark fw-bold"><?php echo e($item->title); ?></h6>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-calendar-event"></i>
                                        <?php echo e($item->created_at ? $item->created_at->format('d/m/Y') : 'Không có thông tin'); ?>

                                    </p>
                                    <a href="<?php echo e(route('news.shows', $item->id)); ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> Xem Chi Tiết
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <style>
        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 180px;
            object-fit: cover;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/client/news/index.blade.php ENDPATH**/ ?>