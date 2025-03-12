<?php $__env->startSection('item-brand', 'open'); ?>
<?php $__env->startSection('item-brand-index', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1>Chỉnh Sửa Thương Hiệu</h1>

        <form action="<?php echo e(route('brands.update', $brand)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Tên Thương Hiệu</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($brand->name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="text" name="text" rows="3"><?php echo e($brand->text); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/brands/edit.blade.php ENDPATH**/ ?>