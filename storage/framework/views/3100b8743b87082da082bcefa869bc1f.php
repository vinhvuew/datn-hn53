<?php $__env->startSection('item-product', 'open'); ?>
<?php $__env->startSection('item-product-index', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span><span> Chi tiết - <?php echo e($product->name); ?></span>
            </h4>
            <div class="app-ecommerce">
                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-8">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-name">Tên sp</label>
                                    <input type="text" class="form-control" value="<?php echo e($product->name); ?>" disabled>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><label class="form-label" for="ecommerce-product-sku">Mã sp</label>
                                        <input type="text" class="form-control" value="<?php echo e($product->sku); ?>" disabled>
                                    </div>
                                    <div class="col"><label class="form-label" for="ecommerce-product-sku">Số
                                            lượng</label>
                                        <input type="number" class="form-control" value="<?php echo e($product->quantity); ?>"
                                            disabled>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-name">Mô tả</label>
                                    <textarea type="text" class="form-control" disabled><?php echo e($product->description); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Nội dung</label>
                                    <textarea type="text" class="form-control" disabled><?php echo e($product->content); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Hình ảnh</label>
                                    <img src="<?php echo e(asset('storage/' . $product->img_thumbnail)); ?> alt="Product Image">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Hướng dẫn sử dụng</label>
                                    <input type="text" class="form-control" value="<?php echo e($product->user_manual); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Album ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3" id="gallery-container">
                                    <div id="gallery_1">
                                        <?php if($product->images->isNotEmpty()): ?>
                                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img src="<?php echo e(Storage::url($item->img)); ?>" alt="Product Image" width="50px"
                                                    class="rounded">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <p>Không có hình ảnh nào cho sản phẩm này.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Thuộc Tính</h5>
                                <?php if($product->variants->isEmpty()): ?>
                                    <em>Không có biến thể</em>
                                <?php else: ?>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Sku</th>
                                                <th>Giá nhập</th>
                                                <th>Giá bán</th>
                                                <th>Tồn Kho</th>
                                                <th>Ảnh biến thể</th>
                                                <th>Thuộc Tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($variant->sku); ?></td>
                                                    <td><?php echo e(number_format($variant->wholesale_price, 0, ',', '.')); ?> VND
                                                    </td>
                                                    <td><?php echo e(number_format($variant->selling_price, 0, ',', '.')); ?> VND
                                                    </td>
                                                    <td><?php echo e($variant->quantity); ?></td>
                                                    <td>
                                                        <?php if($variant->image): ?>
                                                            <img src="<?php echo e(Storage::url($variant->image)); ?>" width="50px"
                                                                class="rounded">
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
                            </div>
                        </div>
                        <!-- /Product Information -->
                    </div>
                    <!-- Second column -->
                    <div class="col-12 col-lg-4">
                        <div class="card mb-4 p-3">
                            <div class="mb-3">
                                <label class="form-label"><strong>Hoạt động:</strong></label>
                                <span><?php echo $product->is_active ? '✅' : '❌'; ?></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Ưu đãi tốt:</strong></label>
                                <span><?php echo $product->is_good_deal ? '✅' : '❌'; ?></span>
                            </div>

                            

                            <div class="mb-3">
                                <label class="form-label"><strong>Sản phẩm nổi bật:</strong></label>
                                <span><?php echo $product->is_show_home ? '✅' : '❌'; ?></span>
                            </div>
                        </div>

                        <!-- /danh mục -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Danh mục & Thương hiệu</h5>
                            </div>
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select name="category_id" class="form-select" disabled>
                                        <option><?php echo e($product->category->name); ?></option>
                                    </select>
                                </div>
                                <!-- thương hiệu -->
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select name="brand_id" class="form-select" disabled>
                                        <option><?php echo e($product->brand->name); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Pricing Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Giá tiền</h5>
                            </div>
                            <div class="card-body">
                                <!-- Base Price -->
                                <div class="mb-3">
                                    <label class="form-label" for="base_price">Giá cơ bản</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND" disabled>

                                </div>
                                <!-- Discounted Price -->
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-discount-price">Giá bán</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo e(number_format($product->price_sale, 0, ',', '.')); ?> VNĐ" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /Pricing Card -->
                    </div>
                    <!-- /Second column -->
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/products/show.blade.php ENDPATH**/ ?>