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
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 mt-4"
                                    src="<?php echo e(asset('themes')); ?>/admin/img/avatars/10.png" height="120" width="120"
                                    alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4><?php echo e($role->name); ?></h4>
                                    <span class="badge bg-label-info rounded-pill"><?php echo e($role->name); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap my-2 py-3">
                            <div class="d-flex align-items-center me-4 mt-3 gap-3">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class='mdi mdi-check mdi-24px'></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-0">1.23k</h4>
                                    <span>Tasks Done</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3 gap-3">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class='mdi mdi-star-outline mdi-24px'></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-0">568</h4>
                                    <span>Projects Done</span>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-3 border-bottom mb-3">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3">
                                    <span class="h6">Username:</span>
                                    <span>@violet.dev</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Email:</span>
                                    <span>vafgot@vultukir.org</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Status:</span>
                                    <span class="badge bg-label-success rounded-pill">Active</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Role:</span>
                                    <span>Author</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Tax id:</span>
                                    <span>Tax-8965</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Contact:</span>
                                    <span>(123) 456-7890</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Languages:</span>
                                    <span>French</span>
                                </li>
                                <li class="mb-3">
                                    <span class="h6">Country:</span>
                                    <span>England</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                    data-bs-toggle="modal">Edit</a>
                                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspend</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
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