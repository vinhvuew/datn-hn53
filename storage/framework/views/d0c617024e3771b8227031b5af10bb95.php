<?php $__env->startSection('item-product', 'open'); ?>
<?php $__env->startSection('item-product-index', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Sản phẩm /</span> Danh sách sản phẩm
        </h4>
        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h6 class="mb-2">In-store Sales</h6>
                                    <h4 class="mb-2">$5,345.43</h4>
                                    <p class="mb-0">
                                        <span class="text-muted me-2">5k orders</span><span
                                            class="badge bg-label-success">+5.7%</span>
                                    </p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="bx bx-store-alt bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h6 class="mb-2">Website Sales</h6>
                                    <h4 class="mb-2">$674,347.12</h4>
                                    <p class="mb-0">
                                        <span class="text-muted me-2">21k orders</span><span
                                            class="badge bg-label-success">+12.4%</span>
                                    </p>
                                </div>
                                <div class="avatar me-lg-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="bx bx-laptop bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h6 class="mb-2">Discount</h6>
                                    <h4 class="mb-2">$14,235.12</h4>
                                    <p class="mb-0 text-muted">6k orders</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="bx bx-gift bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-2">Affiliate</h6>
                                    <h4 class="mb-2">$8,345.23</h4>
                                    <p class="mb-0">
                                        <span class="text-muted me-2">150 orders</span><span
                                            class="badge bg-label-danger">-3.5%</span>
                                    </p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="bx bx-wallet bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Tên sp</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá cơ bản</th>
                            <th>Giá bán</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->id); ?></td>
                                <td><?php echo e($item->category->name); ?></td>
                                <td><?php echo e($item->brand->name); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><img src="<?php echo e(Storage::url($item->img_thumbnail)); ?>" width="50px"></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(number_format($item->base_price, 0, ',', '.')); ?> VND</td>
                                <td><?php echo e(number_format($item->price_sale, 0, ',', '.')); ?> VND</td>
                                <td>
                                    <?php if($item->variants->isEmpty()): ?>
                                        <em>Không có biến thể</em>
                                    <?php else: ?>
                                        <h4>Biến thể sản phẩm</h4>
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

                                                <?php $__currentLoopData = $item->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($variant->sku); ?></td>
                                                        <td><?php echo e(number_format($variant->wholesale_price, 0, ',', '.')); ?> VND
                                                        </td>
                                                        <td><?php echo e(number_format($variant->selling_price, 0, ',', '.')); ?> VND
                                                        </td>
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
                                <td>
                                    <a href="<?php echo e(route('products.show', $item->id)); ?>" class="btn btn-success">Chi
                                        tiết</a>
                                    <a href="<?php echo e(route('products.edit', $item->id)); ?>" class="btn btn-warning">Chỉnh
                                        sửa</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/admin/products/index.blade.php ENDPATH**/ ?>