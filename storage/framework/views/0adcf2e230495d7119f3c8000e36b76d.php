<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">eCommerce /</span> Category List
        </h4>

        <div class="app-ecommerce-category">
            <!-- Search Bar and Add Category Button in a Single Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Search Bar -->
                <div style="width: 25%;" class="me-2">
                    <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." />
                </div>
                <!-- Add Category Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasEcommerceCategoryList" aria-controls="offcanvasEcommerceCategoryList">
                    + Add Category
                </button>
            </div>

            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th class="text-nowrap text-sm-end">Total Products</th>
                                <th class="text-nowrap text-sm-end">Total Earnings</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Placeholder Rows -->
                            <tr>
                                <td>1</td>
                                <td>Electronics</td>
                                <td>-</td>
                                <td class="text-sm-end">120</td>
                                <td class="text-sm-end">$15,200</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Household</td>
                                <td>-</td>
                                <td class="text-sm-end">80</td>
                                <td class="text-sm-end">$8,500</td>
                                <td class="text-center">
                                    <span class="badge bg-warning">Inactive</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kitchen Appliances</td>
                                <td>Household</td>
                                <td class="text-sm-end">50</td>
                                <td class="text-sm-end">$5,200</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/category/index.blade.php ENDPATH**/ ?>