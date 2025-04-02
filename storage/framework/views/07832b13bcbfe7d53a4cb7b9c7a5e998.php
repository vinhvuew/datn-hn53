<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">Tạo Voucher Mới</h1>

        <!-- Thông báo lỗi hoặc thành công (nếu có) -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form tạo voucher -->
        <form action="<?php echo e(route('vouchers.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card">
                <div class="card-body">
                    
                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher</label>
                        <input type="text" name="code" class="form-control" placeholder="Nhập mã voucher" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="name">Tên Voucher</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên voucher" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="discount_type">Loại Giảm Giá</label>
                        <select name="discount_type" id="discount_type" class="form-control" required>
                            <option value="fixed">Cố định (VNĐ)</option>
                            <option value="percentage">Phần trăm (%)</option>
                        </select>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="discount_value">Giá Trị Giảm Giá (<span id="discount_label">VNĐ</span>)</label>
                        <input type="number" name="discount_value" id="discount_value" class="form-control"
                            placeholder="Nhập giá trị giảm giá" required min="0">
                        <small id="discount_error" class="text-danger d-none">Phần trăm giảm giá không thể lớn hơn 90%.</small>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="min_order_value">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                        <input type="number" name="min_order_value" id="min_order_value" class="form-control"
                            placeholder="Giá trị đơn hàng tối thiểu" min="0">
                        <small id="order_error" class="text-danger d-none">Giá trị đơn hàng phải lớn hơn giá trị giảm giá.</small>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="max_discount_value">Giảm Giá Tối Đa (VNĐ)</label>
                        <input type="number" name="max_discount_value" id="max_discount_value" class="form-control"
                            placeholder="Nhập giá trị giảm giá tối đa" min="0" disabled>
                        <small id="max_discount_error" class="text-danger d-none">Giá trị giảm giá tối đa không hợp lệ!</small>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="start_date">Ngày Bắt Đầu</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="end_date">Ngày Hết Hạn</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Hoạt động</option>
                            <option value="expired">Hết hạn</option>
                            <option value="disabled">Vô hiệu hóa</option>
                        </select>
                    </div>

                    
                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-success">Lưu Voucher</button>
                        <a href="<?php echo e(route('vouchers.index')); ?>" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const discountType = document.querySelector("#discount_type");
            const discountValue = document.querySelector("#discount_value");
            const discountLabel = document.querySelector("#discount_label");
            const discountError = document.querySelector("#discount_error");
            const minOrderValue = document.querySelector("#min_order_value");
            const orderError = document.querySelector("#order_error");
            const maxDiscountValue = document.querySelector("#max_discount_value");
            const startDate = document.querySelector("[name='start_date']");
            const endDate = document.querySelector("[name='end_date']");

            const maxDiscountError = document.createElement("small");
            maxDiscountError.classList.add("text-danger", "d-none");
            maxDiscountValue.parentNode.appendChild(maxDiscountError);

            function updateDiscountInput() {
                const isPercentage = discountType.value === "percentage";

                // Cập nhật nhãn và placeholder
                discountLabel.textContent = isPercentage ? "%" : "VNĐ";
                discountValue.placeholder = isPercentage ? "Nhập phần trăm giảm giá (tối đa 90%)" :
                    "Nhập số tiền giảm giá";
                discountValue.value = isPercentage ? 10 : 50000;
                discountValue.min = 0;
                discountValue.max = isPercentage ? 90 : null;

                // Kiểm soát trường "Giảm giá tối đa"
                maxDiscountValue.disabled = !isPercentage;
                maxDiscountValue.value = isPercentage ? maxDiscountValue.value : "";
                maxDiscountError.classList.add("d-none");

                validateDiscount();
                validateOrderValue();
                validateMaxDiscount();
            }

            function validateDiscount() {
                const discount = parseFloat(discountValue.value) || 0;
                discountError.classList.toggle("d-none", !(discountType.value === "percentage" && discount > 90));
            }

            function validateOrderValue() {
                const discount = parseFloat(discountValue.value) || 0;
                const minOrder = parseFloat(minOrderValue.value) || 0;
                orderError.classList.toggle("d-none", !(minOrder > 0 && minOrder < discount));
            }

            function validateMaxDiscount() {
                const discount = parseFloat(discountValue.value) || 0;
                const maxDiscount = parseFloat(maxDiscountValue.value) || 0;
                const minOrder = parseFloat(minOrderValue.value) || 0;

                if (discountType.value === "percentage" && maxDiscount > 0 && minOrder > 0 && maxDiscount > (
                        discount / 100) * minOrder) {
                    maxDiscountError.textContent = "Giá trị giảm giá tối đa không hợp lệ!";
                    maxDiscountError.classList.remove("d-none");
                } else {
                    maxDiscountError.classList.add("d-none");
                }
            }

            function validateDateRange() {
                if (startDate.value && endDate.value && startDate.value > endDate.value) {
                    alert("Ngày bắt đầu không thể lớn hơn ngày hết hạn!");
                    endDate.value = "";
                }
            }

            // Gán sự kiện
            discountType.addEventListener("change", updateDiscountInput);
            discountValue.addEventListener("input", () => {
                validateDiscount();
                validateOrderValue();
                validateMaxDiscount();
            });
            minOrderValue.addEventListener("input", () => {
                validateOrderValue();
                validateMaxDiscount();
            });
            maxDiscountValue.addEventListener("input", validateMaxDiscount);
            startDate.addEventListener("change", validateDateRange);
            endDate.addEventListener("change", validateDateRange);

            updateDiscountInput();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/admin/vouchers/create.blade.php ENDPATH**/ ?>