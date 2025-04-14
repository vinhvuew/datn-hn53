<?php $__env->startSection('item-category', 'open'); ?>
<?php $__env->startSection('item-category-index', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">

            <span class="text-muted fw-light">Danh mục /</span> Danh sách danh mục

        </h4>

        <div class="app-ecommerce-category">
            <!-- Search Bar and Add Category Button in a Single Row -->

            <?php if(session('categorySuccess')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('categorySuccess')); ?>

                </div>
            <?php endif; ?>

            <!-- Category List Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-end align-items-center">
                    <a class="btn btn-primary me-2" href="<?php echo e(route('category.create')); ?>">
                        + THÊM DAMH MỤC</a>
                </div>
                <div class="card-body">
                    <table id="example"
                        class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>Tên danh mục</th>
                                
                                <th class="text-center">Hành động</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->id); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    
                                    <td class="text-center">
                                        <a href="<?php echo e(route('category.edit', $item->id)); ?>"
                                            class="btn btn-sm btn-primary">Chỉnh sửa</a>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <div class="content-backdrop fade"></div>


    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.parials.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>