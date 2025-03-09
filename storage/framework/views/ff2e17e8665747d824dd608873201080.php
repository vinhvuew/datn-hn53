
<?php $__env->startSection('content'); ?>
    <div class="app-ecommerce-order">
        <!-- Order Form -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceOrderForm"
            aria-labelledby="offcanvasEcommerceOrderFormLabel">
            <!-- Offcanvas Header -->
            <div class="offcanvas-header py-4">
                <h5 id="offcanvasEcommerceOrderFormLabel" class="offcanvas-title">Add Order</h5>
                <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- Offcanvas Body -->
            <div class="offcanvas-body border-top">
                <form class="pt-0" id="eCommerceOrderForm" onsubmit="return true">
                    <!-- ID -->
                    <div class="mb-3">
                        <label class="form-label" for="order-id">Order ID</label>
                        <input type="text" class="form-control" id="order-id" placeholder="Enter Order ID"
                            name="id" aria-label="Order ID">
                    </div>
                    <!-- User ID -->
                    <div class="mb-3">
                        <label class="form-label" for="order-id-user">User ID</label>
                        <input type="text" class="form-control" id="order-id-user" placeholder="Enter User ID"
                            name="id_user" aria-label="User ID">
                    </div>
                    <!-- Status ID -->
                    <div class="mb-3">
                        <label class="form-label" for="order-id-status">Status ID</label>
                        <input type="text" class="form-control" id="order-id-status" placeholder="Enter Status ID"
                            name="id_status" aria-label="Status ID">
                    </div>
                    <!-- Shipping Address -->
                    <div class="mb-3">
                        <label class="form-label" for="order-shipping-address">Shipping Address</label>
                        <input type="text" class="form-control" id="order-shipping-address"
                            placeholder="Enter Shipping Address" name="shipping_address" aria-label="Shipping Address">
                    </div>
                    <!-- Total Price -->
                    <div class="mb-3">
                        <label class="form-label" for="order-total-price">Total Price</label>
                        <input type="number" class="form-control" id="order-total-price" placeholder="Enter Total Price"
                            name="total_price" aria-label="Total Price">
                    </div>
                    <!-- Voucher -->
                    <div class="mb-3">
                        <label class="form-label" for="order-voucher">Voucher</label>
                        <input type="text" class="form-control" id="order-voucher" placeholder="Enter Voucher Code"
                            name="voucher" aria-label="Voucher">
                    </div>
                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label" for="order-pay">Payment Method</label>
                        <input type="text" class="form-control" id="order-pay" placeholder="Enter Payment Method"
                            name="pay" aria-label="Payment Method">
                    </div>
                    <!-- Payment Status -->
                    <div class="mb-3">
                        <label class="form-label" for="order-status-pay">Payment Status</label>
                        <select id="order-status-pay" class="select2 form-select" name="status_pay"
                            aria-label="Payment Status">
                            <option value="">Select Payment Status</option>
                            <option value="Paid">Paid</option>
                            <option value="Pending">Pending</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <!-- Created At -->
                    <div class="mb-3">
                        <label class="form-label" for="order-created-at">Created At</label>
                        <input type="datetime-local" class="form-control" id="order-created-at" name="created_at"
                            aria-label="Created At">
                    </div>
                    <!-- Updated At -->
                    <div class="mb-3">
                        <label class="form-label" for="order-updated-at">Updated At</label>
                        <input type="datetime-local" class="form-control" id="order-updated-at" name="updated_at"
                            aria-label="Updated At">
                    </div>
                    <!-- Submit and Reset -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Add Order</button>
                        <button type="reset" class="btn bg-label-danger" data-bs-dismiss="offcanvas">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/add.blade.php ENDPATH**/ ?>