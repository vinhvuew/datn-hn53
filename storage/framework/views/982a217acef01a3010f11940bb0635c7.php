<?php $__env->startSection('content'); ?>
<h1>Edit Voucher</h1>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<form action="<?php echo e(route('vouchers.update', $voucher->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div class="form-group">
        <label for="voucher">Voucher Code</label>
        <input type="text" name="voucher" id="voucher" class="form-control" value="<?php echo e(old('voucher', $voucher->voucher)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $voucher->name)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="valid_from">Valid From</label>
        <input type="date" name="valid_from" id="valid_from" class="form-control" value="<?php echo e(old('valid_from', $voucher->valid_from)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="valid_to">Valid To</label>
        <input type="date" name="valid_to" id="valid_to" class="form-control" value="<?php echo e(old('valid_to', $voucher->valid_to)); ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/edit.blade.php ENDPATH**/ ?>