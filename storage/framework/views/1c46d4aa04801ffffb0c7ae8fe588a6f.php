<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <h1 class="text-center mb-4">Chi tiết sản phẩm</h1>
    <a href="<?php echo e(route('orders')); ?>" class="btn btn-warning">Back</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center mt-2">
            <thead class="table-primary">
                <tr>
                    <th>User</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Voucher</th>
                    <th>Total Money</th>
                    <th>Pay</th>
                    <th>Status Pay</th>
                    <th>Status Order</th>
                    <th>Created_at</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order_detail->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order_detail->users?->name ?? 'Không có tên người dùng'); ?></td>
                        <td><?php echo e($order_detail->shipping_address); ?></td>
                        <td><?php echo e($product->name); ?></td>
                        <td><img src="<?php echo e(asset('storage/' . $product->img_thumbnail)); ?>" alt="Product Image" width="80"></td>
                        <td><?php echo e($product->pivot->quantity); ?></td>
                        <td><?php echo e($product->pivot->price); ?>VNĐ</td>
                        <td><?php echo e($order_detail->vouchers->name ?? 'Không có'); ?></td>
                        <td><?php echo e($order_detail->total_price); ?>VNĐ</td>
                        <td><?php echo e($order_detail->pay); ?></td>
                        <td><?php echo e($order_detail->status_pay ? 'Đã thanh toán' : 'Chưa thanh toán'); ?></td>
                        <td><?php echo e($order_detail->status_order->status_name); ?></td>
                        <td><?php echo e($order_detail->created_at); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>