<?php $__env->startSection('item-category', 'open'); ?>

<?php $__env->startSection('item-category-create', 'active'); ?>

<?php $__env->startSection('content'); ?>

<<<<<<< HEAD
=======
<<<<<<< HEAD

=======
>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
>>>>>>> ea6a7cd349b709be7207fb79d4af2e80f8c6e1ca
=======
>>>>>>> d640a94395e5aad28536339b2c07f9aa66b7258e
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Danh mục /</span> Thêm mới danh mục
            </h4>

            <div class="app-ecommerce-category">
                <!-- Search Bar and Add Category Button in a Single Row -->
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <a href="<?php echo e(route('category.index')); ?>" class="btn btn-info">
                        Quay lại
                    </a>
                </div>

                <div class="row">
                    <!-- Category List Table -->
                    <div class="card">
                        <div class="card-datatable table-responsive">
                            <form action="<?php echo e(route('category.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Danh Mục</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo e(old('name')); ?>">
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

                                <button type="submit" class="btn btn-primary mb-3">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

<<<<<<< HEAD
=======
<<<<<<< HEAD

=======
>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
>>>>>>> ea6a7cd349b709be7207fb79d4af2e80f8c6e1ca
=======
>>>>>>> d640a94395e5aad28536339b2c07f9aa66b7258e
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>