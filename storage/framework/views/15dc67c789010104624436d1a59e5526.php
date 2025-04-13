<?php $__env->startSection('title'); ?>
    Quyền truy cập
<?php $__env->stopSection(); ?>
<?php $__env->startSection('item-user'); ?>
    open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('user-role'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Tài Khoản /</span><span> <?php echo e($role->name); ?></span>
        </h4>
        <?php if(session('success')): ?>
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 50px">
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thành Công!</strong> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('errors')): ?>
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 50px">
                <div id="success-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Thất bại!</strong> <?php echo e(session('errors')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- User Sidebar -->
            
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-12 col-lg-7 col-md-7 order-0 order-md-1">
                <!--/ User Tabs -->

                <!-- Project table -->
                <form action="<?php echo e(route('permissions.updateGant')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card mb-4">
                        <!-- Notifications -->
                        <h5 class="card-header border-bottom">Quyền truy cập</h5>
                        <div class="card-body py-3">
                            <span class="text-heading fw-medium">Thay đổi quyền truy cập, người dùng sẽ nhận quyền truy
                                cập</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-nowrap">Quyền truy cập</th>
                                        <th class="text-nowrap text-center">Xem</th>
                                        <th class="text-nowrap text-center">Thêm</th>
                                        <th class="text-nowrap text-center">Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $category = [
                                            'categorys.index' => 'Xem',
                                            'categorys.create' => 'Thêm',
                                            'categorys.edit' => 'Sửa',
                                        ];
                                        $orders = [
                                            'orders.index' => 'Xem',
                                            'orders.create' => 'Xem',
                                            'orders.edit' => 'Sửa',
                                        ];
                                        $products = [
                                            'products.index' => 'Xem',
                                            'products.create' => 'Thêm',
                                            'products.edit' => 'Sửa',
                                        ];
                                        $brands = [
                                            'brands.index' => 'Xem',
                                            'brands.create' => 'Thêm',
                                            'brands.edit' => 'Sửa',
                                        ];
                                        $attribute = [
                                            'attributes.index' => 'Xem',
                                            'attributes.create' => 'Thêm',
                                            'attributes.edit' => 'Sửa',
                                        ];
                                        $attribute_value = [
                                            'attribute_values.index' => 'Xem',
                                            'attribute_values.create' => 'Thêm',
                                            'attribute_values.edit' => 'Sửa',
                                        ];
                                        $vouchers = [
                                            'vouchers.index' => 'Xem',
                                            'vouchers.create' => 'Thêm',
                                            'vouchers.edit' => 'Sửa',
                                        ];
                                    ?>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý danh mục</td>
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->slug == $slug): ?>
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý Thương hiệu</td>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->slug == $slug): ?>
                                                    
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý đơn hàng</td>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->slug == $slug): ?>
                                                    <?php if($slug == 'orders.create'): ?>
                                                        <td>
                                                            <div class="form-check mb-0 d-flex justify-content-center">
                                                                <input class="form-check-input d-none" type="checkbox"
                                                                    <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                    name="permissions[<?php echo e($role->id); ?>][]"
                                                                    value="<?php echo e($item->id); ?>" />
                                                            </div>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <div class="form-check mb-0 d-flex justify-content-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                    name="permissions[<?php echo e($role->id); ?>][]"
                                                                    value="<?php echo e($item->id); ?>" />
                                                            </div>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý sản phẩm</td>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->slug == $slug): ?>
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý thuộc tính</td>
                                        <?php $__currentLoopData = $attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleAttribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->slug == $slug): ?>
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý giá trị thuộc tính</td>
                                        <?php $__currentLoopData = $attribute_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleAttribute_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <?php if($item->slug == $slug): ?>
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap text-heading">Quản lý Khuyến mãi</td>
                                        <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $roleVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <?php if($item->slug == $slug): ?>
                                                    <td>
                                                        <div class="form-check mb-0 d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                <?php echo e($item->roles->contains($role->id) ? 'checked' : ''); ?>

                                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                                value="<?php echo e($item->id); ?>" />
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary me-2">Lưu Lại</button>
                            <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-info me-2"> Quay lai</a>
                            
                            <button type="reset" class="btn btn-outline-secondary">Đăt lại</button>
                        </div>
                        <!-- /Notifications -->
                    </div>
                </form>
                <!-- /Project table -->
            </div>
            <!--/ User Content -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/roles/grant.blade.php ENDPATH**/ ?>