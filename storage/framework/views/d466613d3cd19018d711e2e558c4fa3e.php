<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <h1 class="text-center">Chỉnh sửa trạng thái đơn hàng</h1>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>

        <div class="mb-3">
            <label for="status_order_id" class="form-label">Trạng thái đơn hàng</label>
            <select name="status_order_id" id="status_order_id" class="form-select" required 
                <?php echo e($order->status_order_id == 4 ? 'disabled' : ''); ?>> 
                
                <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->id); ?>"
                        <?php echo e($order->status_order_id == $status->id ? 'selected' : ''); ?>

                        <?php if(in_array($order->status_order_id, [3, 4]) && $status->id < $order->status_order_id): ?>
                            disabled
                        <?php endif; ?>
                    >
                        <?php echo e($status->status_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <?php if($order->status_order_id != 4): ?>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        <?php else: ?>
            <div class="alert alert-info">Đơn hàng đã giao thành công. Không thể chỉnh sửa trạng thái.</div>
        <?php endif; ?>

        <a href="<?php echo e(route('orders')); ?>" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/edit.blade.php ENDPATH**/ ?>