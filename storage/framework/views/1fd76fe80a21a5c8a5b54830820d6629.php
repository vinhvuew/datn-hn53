<?php $__env->startSection('content'); ?>
<main>
    <div class="container py-5">
        <h3 class="text-center mb-4" style="font-weight: 600; color: #333;">Danh sách người dùng nhắn tin</h3>

        <div class="list-group">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="list-group-item d-flex justify-content-between align-items-center mb-3 p-3 rounded-lg shadow-lg bg-white">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <img src="<?php echo e($user->user->profile_picture ?? 'default-avatar.jpg'); ?>" alt="Profile Picture" class="rounded-circle border" width="50" height="50">
                    </div>
                    <span class="font-weight-semibold text-dark"><?php echo e($user->user->name ?? 'User ' . $user->user_id); ?></span>
                </div>

                <div class="btn-group">
                    <a href="<?php echo e(route('admin.chat.show', $user->user_id)); ?>" class="btn btn-outline-primary btn-sm rounded-pill">Xem</a>
                    <form action="<?php echo e(route('admin.chat.delete', $user->user_id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')">Xoá</button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/chat/index.blade.php ENDPATH**/ ?>