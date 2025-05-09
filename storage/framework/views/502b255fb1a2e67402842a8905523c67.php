<?php $__env->startSection('item-atribute', 'open'); ?>

<?php $__env->startSection('item-atribute-value', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">GIÁ TRỊ THUỘC TÍNH /</span> DANH SÁCH GIÁ TRỊ THUỘC TÍNH
        </h4>
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success fw-bold">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>


    </div>

    <!-- Category List Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a class="btn btn-primary me-2" href="<?php echo e(route('attribute-values.create')); ?>">
                <i class="mdi mdi-plus me-0 me-sm-1"></i>
                + THÊM GIÁ TRỊ THUỘC TÍNH</a>
        </div>
        <div class="card-body">
            <table id="example" class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                style="width:100%">
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

                                <a href="<?php echo e(route('attribute-values.edit', $value->id)); ?>" class="btn btn-warning">Sửa</a>
                                
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/attribute_values/index.blade.php ENDPATH**/ ?>