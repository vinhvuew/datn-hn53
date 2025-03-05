<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách Voucher</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php elseif(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Nút tạo voucher mới -->
        <a href="<?php echo e(route('vouchers.create')); ?>" class="btn btn-primary mb-3">Tạo Voucher Mới</a>

        <!-- Bảng danh sách voucher -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Tên</th>
                            <th>Giảm giá</th>
                            <th>điều kiện áp dụng</th>
                            <th>số lượng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($voucher->code); ?></td>
                                <td><?php echo e($voucher->name); ?></td>
                                <td>
                                    <?php echo e($voucher->discount_type == 'percentage'
                                        ? number_format($voucher->discount_value) . '%'
                                        : number_format($voucher->discount_value, 3) . ' VND'); ?>

                                </td>
                                <td><?php echo e(number_format($voucher->min_order_value, 3) . ' VND'); ?></td>
                                <td><?php echo e(number_format($voucher->max_discount_value, 0)); ?></td>
                                <td>
                                    <span
                                        class="badge <?php echo e($voucher->status == 'active' ? 'bg-success' : ($voucher->status == 'expired' ? 'bg-danger' : 'bg-secondary')); ?>">
                                        <?php echo e(ucfirst($voucher->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('vouchers.edit', $voucher->id)); ?>"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="<?php echo e(route('vouchers.destroy', $voucher->id)); ?>" method="POST"
                                        style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/index.blade.php ENDPATH**/ ?>