<?php $__env->startSection('title'); ?>
    Cập nhật quyền truy cập
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu-item-account'); ?>
    open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu-sub-permission'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Tài Khoản /</span> Cập nhật quyền truy cập
        </h4>
        <form action="<?php echo e(route('permissions.update', $dataID->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Cập nhật quyền truy cập</h4>
                        <p>Quản lý quyền cho các chức năng cho hệ thống</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-info">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary">
                            Cập nhật
                        </button>
                    </div>
                </div>

                <div class="row">

                    <!-- Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Thông tin quyền truy cập</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Quyền</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="<?php echo e($dataID->name); ?>">
                                </div>
                                <div class="col-6">
                                    <label for="">Quyền</label>
                                    <span class="text-danger" style="margin-left: 125px">* Trường này nhập theo định dạng
                                        (Table . function)</span>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="<?php echo e($dataID->slug); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('themes')); ?>/admin/js/app-ecommerce-product-add.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/permissions/edit.blade.php ENDPATH**/ ?>