<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h1 class="text-center mb-4">Quản lý đơn hàng</h1>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">User</th>
                        <th scope="col">Address</th>
                        <th scope="col">Voucher</th>
                        <th scope="col">Total Money</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Status Pay</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e($order->user_name); ?></td>
                            <td><?php echo e($order->shipping_address); ?></td>
                            <td><?php echo e($order->voucher_name); ?></td>
                            <td><?php echo e(($order->total_price)); ?>vnđ  </td>
                            <td><?php echo e($order->pay); ?></td>
                            <td><?php echo e($order->status_pay); ?></td>
                            <td><?php echo e($order->status_name); ?></td>
                            <td><?php echo e($order->created_at); ?></td>
                            <td><?php echo e($order->updated_at); ?></td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-info">Detail</a>
                                    <a href="<?php echo e(route('orders.edit', $order->id)); ?> " class="btn btn-warning">Edit</a>
                                    <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" class="m-0 p-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>