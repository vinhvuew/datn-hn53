<?php $__env->startSection('item-brand', 'open'); ?>
<?php $__env->startSection('item-brand-index', 'active'); ?>
<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> ea6a7cd349b709be7207fb79d4af2e80f8c6e1ca
=======

>>>>>>> c15ac78eb9e5a7360e30aad08da3d4eb600aed78
    <div class="container mt-5">
        <h1>Danh Sách Thương Hiệu</h1>
        <a class="btn btn-primary mb-3" href="<?php echo e(route('brands.create')); ?>">Thêm Thương Hiệu</a>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary text-center">
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> ea6a7cd349b709be7207fb79d4af2e80f8c6e1ca
=======

>>>>>>> c15ac78eb9e5a7360e30aad08da3d4eb600aed78
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo e($brand->id); ?></td>
                        <td class="align-middle"><?php echo e($brand->name); ?></td>
                        <td class="align-middle"><?php echo e($brand->text); ?></td>
                        <td class="text-center align-middle">
                            <a href="<?php echo e(route('brands.edit', $brand)); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="<?php echo e(route('brands.destroy', $brand)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
<?php $__env->stopSection(); ?>
<<<<<<< HEAD
<<<<<<< HEAD

=======
<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
>>>>>>> ea6a7cd349b709be7207fb79d4af2e80f8c6e1ca
=======

>>>>>>> c15ac78eb9e5a7360e30aad08da3d4eb600aed78
<?php $__env->startSection('script-libs'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/brands/index.blade.php ENDPATH**/ ?>