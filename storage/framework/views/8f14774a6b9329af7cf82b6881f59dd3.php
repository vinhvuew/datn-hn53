<?php $__env->startSection('item-product', 'open'); ?>
<?php $__env->startSection('item-product-index', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Sản phẩm /</span> Danh sách sản phẩm
        </h4>
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="card">
            <!-- Search Bar and Add Product Button -->
            <div class="card-header d-flex justify-content-end align-items-center">
                <a class="btn btn-primary me-2" href="<?php echo e(route('products.create')); ?>">
                    + THÊM SẢN PHẨM</a>
            </div>
            <!-- Product Table -->
            <div class="card-body">
                <table id="example"
                    class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            
                            <th>Tên sp</th>
                            <th>Hình ảnh</th>
                            
                            <th>Giá Gốc</th>
                            <th>Giá Bán</th>
                            <th>trạng thái</th>
                            <th>Thao tác</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->id); ?></td>
                                
                                <td><?php echo e(Str::limit($item->name, 15)); ?></td>
                                <td><img src="<?php echo e(Storage::url($item->img_thumbnail)); ?>" width="50px"></td>
                                
                                <td><?php echo e(number_format($item->base_price, 0, ',', '.')); ?> VND</td>
                                <td><?php echo e(number_format($item->price_sale, 0, ',', '.')); ?> VND</td>
                                <td>
                                    <?php if($item->is_active == 1): ?>
                                        <i class="fas fa-check-circle text-success"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-danger"></i>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="<?php echo e(route('products.show', $item->id)); ?>" class="btn btn-success"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="<?php echo e(route('products.edit', $item->id)); ?>" class="btn btn-warning"> <i
                                            class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <?php if($item->variants->isEmpty()): ?>
                                        <em>Không có biến thể</em>
                                    <?php else: ?>
                                        <h4>Biến thể sản phẩm</h4>
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Sku</th>
                                                    <th>Tồn Kho</th>
                                                    <th>Ảnh biến thể</th>
                                                    <th>Thuộc Tính</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $item->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($variant->sku); ?></td>

                                                        <td><?php echo e($variant->quantity); ?></td>
                                                        <td>
                                                            <?php if($variant->image): ?>
                                                                <img src="<?php echo e(Storage::url($variant->image)); ?>"
                                                                    width="50px" alt="">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($variant->attributes): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $variant->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><?php echo e($attribute->attribute->name); ?>:
                                                                            <?php echo e(Str::limit($attribute->attributeValue->value, 15)); ?>

                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <em>Không có thuộc tính</em>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/products/index.blade.php ENDPATH**/ ?>