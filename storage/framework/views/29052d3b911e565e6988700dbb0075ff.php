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
                <table id="example" class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã Voucher</th>
                            <th>Tên Voucher</th>
                            <th>Giảm giá</th>
                            <th>Điều kiện áp dụng</th>
                            <th>Giảm giá tối đa</th>
                            <th>Trạng thái</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e($voucher->code); ?></td>

                                
                                <td><?php echo e($voucher->name); ?></td>

                                
                                <td>
                                    <?php if($voucher->discount_type == 'percentage'): ?>
                                        <?php echo e(number_format($voucher->discount_value, 0)); ?>%
                                    <?php else: ?>
                                        <?php echo e(number_format($voucher->discount_value, 0)); ?> VND
                                    <?php endif; ?>
                                </td>

                                
                                <td><?php echo e(number_format($voucher->min_order_value, 0)); ?> VND</td>

                                
                                <td>
                                    <?php echo e($voucher->discount_type == 'percentage' && $voucher->max_discount_value ? number_format($voucher->max_discount_value, 0) . ' VND' : '-'); ?>

                                </td>

                                
                                <td>
                                    <?php
                                        $statusClass = match ($voucher->status) {
                                            'active' => 'bg-success',
                                            'expired' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    ?>
                                    <span class="badge <?php echo e($statusClass); ?>"><?php echo e(ucfirst($voucher->status)); ?></span>
                                </td>

                                
                                <td><?php echo e(\Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y')); ?></td>

                                
                                <td><?php echo e(\Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y')); ?></td>

                                
                                <td class="text-center">
                                    <a href="<?php echo e(route('vouchers.edit', $voucher->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="<?php echo e(route('vouchers.destroy', $voucher->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa voucher này?')">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
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
<?php echo $__env->make('admin.layouts.parials.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/index.blade.php ENDPATH**/ ?>