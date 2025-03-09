<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1>Sửa Danh Mục</h1>

    <form action="<?php echo e(route('category.update',$category->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo e(old('name',$category->name)); ?>"> 
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color:red"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form> 
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/admin/categories/edit.blade.php ENDPATH**/ ?>