<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h1 class="text-center mb-4">📊 Doanh Thu Theo Khách Hàng</h1>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>Tên Khách Hàng</th>
                    <th>Doanh Thu (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $doanhThuTheoKhachHang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->user->name); ?></td> <!-- Hiển thị tên khách hàng -->
                        <td><?php echo e(number_format($item->doanh_thu)); ?> VNĐ</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/thongke/doanhthutheokhachhang.blade.php ENDPATH**/ ?>