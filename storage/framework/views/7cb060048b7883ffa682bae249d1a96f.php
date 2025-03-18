<?php $__env->startSection('item-category', 'open'); ?>
<?php $__env->startSection('item-category-index', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">

                <span class="text-muted fw-light">Danh mục /</span> Danh sách danh mục

            </h4>

            <div class="app-ecommerce-category">
                <!-- Search Bar and Add Category Button in a Single Row -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Search Bar -->
                    <div style="width: 25%;" class="me-2">
                        <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." />
                    </div>
                    <!-- Add Category Button -->
                    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-primary">

                        + Thêm mới danh mục

                    </a>
                </div>

                <?php if(session('categorySuccess')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('categorySuccess')); ?>

                    </div>
                <?php endif; ?>

                <!-- Category List Table -->
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="datatables-category-list table border-top" id="tableData">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Tên danh mục</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td class="text-center">

                                            <span class="badge bg-success">Kích hoạt</span>
                                        </td>
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



        <div class="buy-now">
            <a href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/" target="_blank"
                class="btn btn-danger btn-buy-now">Buy Now</a>
        </div>

        <!-- Footer -->
        <div class="content-backdrop fade"></div>



    </div>
    <script>
        const btn = document.querySelectorAll('#submit-form');
        for (const iterator of btn) {
            iterator.addEventListener('click', () => {
                let id = iterator.dataset.id;
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector(`#form-${id}`).submit();
                    }
                });
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>