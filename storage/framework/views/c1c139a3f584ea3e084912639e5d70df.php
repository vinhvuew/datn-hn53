<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Vouchers</span>
        </h4>

        <div class="app-ecommerce-category">
            <div class="card shadow-sm border-0 rounded">
                <div class="d-flex justify-content-between align-items-center p-3 text-white rounded-top">
                    <h5 class="card-title mb-0">Danh sách Vouchers</h5>
                </div>

                <div class="card-datatable table-responsive p-3">
                    <table class="table table-bordered table-hover shadow-sm">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>ID</th>
                                <th>Mã Voucher</th>
                                <th>Tên Voucher</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th class="text-center">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo e($voucher->id); ?></td>
                                    <td class="align-middle"><?php echo e($voucher->voucher); ?></td>
                                    <td class="align-middle"><?php echo e($voucher->name); ?></td>
                                    <td class="align-middle"><?php echo e($voucher->valid_from); ?></td>
                                    <td class="align-middle"><?php echo e($voucher->valid_to); ?></td>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo e(route('vouchers.edit', $voucher->id)); ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <form action="<?php echo e(route('voucher.destroy', $voucher->id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/view.blade.php ENDPATH**/ ?>