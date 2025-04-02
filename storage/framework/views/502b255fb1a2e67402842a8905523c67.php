<?php $__env->startSection('item-atribute', 'open'); ?>

<?php $__env->startSection('item-atribute-value', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">GIÁ TRỊ THUỘC TÍNH /</span> DANH SÁCH GIÁ TRỊ THUỘC TÍNH
        </h4>
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success fw-bold">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>
        <div class="app-ecommerce-category">
            <!-- Search Bar and Add Category Button in a Single Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Search Bar -->
                <div style="width: 25%;" class="me-2">
                    <input type="text" id="searchCategory" class="form-control" placeholder="Search attibutes . .." />
                </div>
                <!-- Add Category Button -->
                
                <div class="card-header d-flex justify-content-end align-items-center">
                    <a class="btn btn-primary me-2" href="<?php echo e(route('attribute-values.create')); ?>">
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        + THÊM GIÁ TRỊ THUỘC TÍNH</a>
                </div>
            </div>

            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table border-top table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>TÊN THUỘC TÍNH</th>
                                <th>GIÁ TRỊ THUỘC TÍNH</th>
                                <th>HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Placeholder Rows -->
                                <tr class="text-center">
                                    <td><?php echo e($value->id); ?></td>
                                    <td><?php echo e($value->attribute->name); ?></td>
                                    <td><?php echo e($value->value); ?></td>
                                    <td>

                                        <a href="<?php echo e(route('attribute-values.edit', $value->id)); ?>"
                                            class="btn btn-warning">Sửa</a>
                                        <form action="<?php echo e(route('attribute-values.destroy', $value->id)); ?>" method="POST"
                                            style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/attribute_values/index.blade.php ENDPATH**/ ?>