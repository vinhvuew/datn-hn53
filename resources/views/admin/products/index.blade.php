@extends('admin.layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">eCommerce /</span> Product
            List
        </h4>

        <!-- Product List Widget -->

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

        <!-- Product List Table -->
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <h5 class="card-title">Filter</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4 product_status">
                        <select class="form-select" id="productStatusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="out_of_stock">Out of Stock</option>
                        </select>
                    </div>
                    <div class="col-md-4 product_category">
                        <select class="form-select" id="productCategoryFilter">
                            <option value="">All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="household">Household</option>
                            <option value="office">Office</option>
                        </select>
                    </div>
                    <div class="col-md-4 product_stock">
                        <select class="form-select" id="productStockFilter">
                            <option value="">Stock Status</option>
                            <option value="in_stock">In Stock</option>
                            <option value="low_stock">Low Stock</option>
                            <option value="out_of_stock">Out of Stock</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Search Bar and Add Product Button -->
            <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                <!-- Search Bar -->
                <div style="width: 25%;" class="me-2">
                    <input type="text" id="searchProduct" class="form-control" placeholder="Search products..." />
                </div>
                <!-- Add Product Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasAddProduct" aria-controls="offcanvasAddProduct">
                    + Add Product
                </button>
            </div>

            <!-- Product Table -->
            <div class="card-datatable table-responsive">
                <table class="datatables-products table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Placeholder Rows -->
                        <tr>
                            <td>1</td>
                            <td><img src="path/to/image.jpg" alt="Product Image" class="img-thumbnail" width="50" />
                            </td>
                            <td>Smartphone</td>
                            <td>Electronics</td>
                            <td>In Stock</td>
                            <td>SP001</td>
                            <td>$500</td>
                            <td>20</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="path/to/image.jpg" alt="Product Image" class="img-thumbnail" width="50" />
                            </td>
                            <td>Microwave</td>
                            <td>Household</td>
                            <td>Low Stock</td>
                            <td>HW002</td>
                            <td>$200</td>
                            <td>5</td>
                            <td><span class="badge bg-warning">Inactive</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Product Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddProduct"
            aria-labelledby="offcanvasAddProductLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddProductLabel" class="offcanvas-title">Add Product</h5>
                <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body border-top">
                <form id="addProductForm">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label class="form-label" for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" placeholder="Enter product name" />
                    </div>
                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label" for="productCategory">Category</label>
                        <select class="form-select" id="productCategory">
                            <option value="">Select category</option>
                            <option value="electronics">Electronics</option>
                            <option value="household">Household</option>
                            <option value="office">Office</option>
                        </select>
                    </div>
                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label" for="productPrice">Price</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter price" />
                    </div>
                    <!-- Stock -->
                    <div class="mb-3">
                        <label class="form-label" for="productStock">Stock</label>
                        <input type="number" class="form-control" id="productStock"
                            placeholder="Enter stock quantity" />
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label" for="productStatus">Status</label>
                        <select class="form-select" id="productStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Add</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="offcanvas">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
