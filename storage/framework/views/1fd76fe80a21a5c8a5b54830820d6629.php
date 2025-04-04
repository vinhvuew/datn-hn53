<?php $__env->startSection('content'); ?>
<main>
    <div class="container">
        <h3>Danh sách người dùng nhắn tin</h3>

        <ul class="list-group">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo e($user->user->name ?? 'User ' . $user->user_id); ?>

                <div>
                    <a href="<?php echo e(route('admin.chat.show', $user->user_id)); ?>" class="btn btn-primary btn-sm">Xem</a>
                    <form action="<?php echo e(route('admin.chat.delete', $user->user_id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')">Xoá</button>
                    </form>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/chat/index.blade.php ENDPATH**/ ?>