<?php $__env->startSection('item-atribute', 'open'); ?>

<?php $__env->startSection('item-atribute-value', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">ThUỘC TÍNH /</span> THÊM THUỘC TÍNH
        </h4>

        <div class="app-ecommerce-category">
            <!-- Add Attribute Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thêm Thuộc Tính</h5>
                </div>
                <?php if(session()->has('success')): ?>
                    <div class="alert alert-danger fw-bold">
                        <?php echo e(session()->get('success')); ?>

                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="<?php echo e(route('attribute-values.store')); ?>" method="POST"
                        class="p-4 border rounded shadow-sm bg-white">
                        <?php echo csrf_field(); ?>
                        <h5 class="mb-4">Thêm Giá Trị Thuộc Tính</h5>
                        <!-- Nút hành động -->
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-check-circle-outline me-1"></i> Xuất bản
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="mdi mdi-reload me-1"></i> Nhập lại
                            </button>
                            <a href="<?php echo e(route('attribute-values.index')); ?>" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>
                        <!-- Dropdown chọn thuộc tính -->
                        <div class="mb-3">
                            <label for="attribute_id" class="form-label">Tên Thuộc Tính</label>
                            <select name="attribute_id" id="attributes_name_id" class="form-select">
                                <option value="" disabled selected>Chọn thuộc tính</option>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['attribute_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Input giá trị thuộc tính -->
                        <div class="mb-3">
                            <label for="value" class="form-label">Giá Trị</label>
                            <input type="text" name="value" id="value" class="form-control" value="<?php echo e(old('value')); ?>"
                                placeholder="Nhập giá trị">
                            <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/attribute_values/create.blade.php ENDPATH**/ ?>