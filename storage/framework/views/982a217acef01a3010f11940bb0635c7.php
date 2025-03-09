<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
    <div class="container mt-5">
        <h1 class="mb-4">Sửa Voucher</h1>

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

        <!-- Form sửa voucher -->
        <form action="<?php echo e(route('vouchers.update', $voucher->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher</label>
                        <input type="text" name="code" class="form-control" value="<?php echo e(old('code', $voucher->code)); ?>"
                            placeholder="Nhập mã voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Tên Voucher</label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $voucher->name)); ?>"
                            placeholder="Nhập tên voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_type">Loại Giảm Giá</label>
                        <select name="discount_type" id="discount_type" class="form-control" required>
                            <option value="percentage"
                                <?php echo e(old('discount_type', $voucher->discount_type ?? '') == 'percentage' ? 'selected' : ''); ?>>
                                Phần trăm</option>
                            <option value="fixed"
                                <?php echo e(old('discount_type', $voucher->discount_type ?? '') == 'fixed' ? 'selected' : ''); ?>>Cố
                                định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giảm Giá</label>
                        <input type="number" step="0.001" name="discount_value" id="discount_value" class="form-control"
                            value="<?php echo e(old(
                                'discount_value',
                                isset($voucher)
                                    ? ($voucher->discount_type == 'percentage'
                                        ? number_format($voucher->discount_value, 0, '.', '') // Phần trăm có 0 chữ số thập phân
                                        : number_format($voucher->discount_value, 3, '.', '')) // Cố định có 3 chữ số thập phân
                                    : '',
                            )); ?>"
                            placeholder="Nhập giá trị giảm giá" required min="0">
                        <small id="discount_error" class="text-danger d-none">Phần trăm giảm giá không thể lớn hơn
                            90%.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="min_order_value">Điều kiện áp dụng</label>
                        <input type="number" name="min_order_value" id="min_order_value" class="form-control"
                            value="<?php echo e(number_format($voucher->min_order_value, 3)); ?>"
                            placeholder="Nhập giá trị đơn hàng tối thiểu" required min="0">
                        <small id="order_error" class="text-danger d-none">Giá trị đơn hàng phải lớn hơn giá trị giảm
                            giá.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">số lượng</label>
                        <input type="text" name="max_discount_value" class="form-control"
                            value="<?php echo e(old('max_discount_value', number_format($voucher->max_discount_value, 0))); ?>"
                            placeholder="Nhập tên voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" required>
                            <option value="active" <?php echo e(old('status', $voucher->status) == 'active' ? 'selected' : ''); ?>>Hoạt
                                động</option>
                            <option value="expired" <?php echo e(old('status', $voucher->status) == 'expired' ? 'selected' : ''); ?>>
                                Hết
                                hạn</option>
                            <option value="disabled" <?php echo e(old('status', $voucher->status) == 'disabled' ? 'selected' : ''); ?>>
                                Vô hiệu hóa</option>
                        </select>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
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
            const discountType = document.getElementById("discount_type");
            const discountValue = document.getElementById("discount_value");
            const discountError = document.getElementById("discount_error");

            function validateDiscount() {
                if (discountType.value === "percentage" && parseFloat(discountValue.value) > 90) {
                    discountValue.value = 90;
                    discountError.classList.remove("d-none"); // Hiển thị cảnh báo
                } else {
                    discountError.classList.add("d-none"); // Ẩn cảnh báo nếu hợp lệ
                }
            }

            discountValue.addEventListener("input", validateDiscount);
            discountType.addEventListener("change", validateDiscount);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const discountValue = document.getElementById("discount_value");
            const minOrderValue = document.getElementById("min_order_value");
            const discountError = document.getElementById("discount_error");
            const orderError = document.getElementById("order_error");

            // Kiểm tra điều kiện min_order_value > discount_value
            function validateOrderValue() {
                if (parseFloat(minOrderValue.value) <= parseFloat(discountValue.value)) {
                    orderError.classList.remove("d-none"); // Hiển thị cảnh báo nếu giá trị không hợp lệ
                } else {
                    orderError.classList.add("d-none"); // Ẩn cảnh báo nếu hợp lệ
                }

                // Kiểm tra phần trăm giảm giá không quá 90%
                if (discountValue.value > 90 && discountValue.value <= 100) {
                    discountError.classList.remove("d-none"); // Hiển thị cảnh báo
                } else {
                    discountError.classList.add("d-none"); // Ẩn cảnh báo nếu hợp lệ
                }
            }

            // Lắng nghe sự kiện input khi thay đổi giá trị
            discountValue.addEventListener("input", validateOrderValue);
            minOrderValue.addEventListener("input", validateOrderValue);

            // Kiểm tra giá trị ban đầu nếu đang chỉnh sửa
            validateOrderValue();
        });
    </script>
<?php $__env->stopSection(); ?>

=======
<h1>Edit Voucher</h1>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<form action="<?php echo e(route('vouchers.update', $voucher->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div class="form-group">
        <label for="voucher">Voucher Code</label>
        <input type="text" name="voucher" id="voucher" class="form-control" value="<?php echo e(old('voucher', $voucher->voucher)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $voucher->name)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="valid_from">Valid From</label>
        <input type="date" name="valid_from" id="valid_from" class="form-control" value="<?php echo e(old('valid_from', $voucher->valid_from)); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="valid_to">Valid To</label>
        <input type="date" name="valid_to" id="valid_to" class="form-control" value="<?php echo e(old('valid_to', $voucher->valid_to)); ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>

<?php $__env->stopSection(); ?>
>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/edit.blade.php ENDPATH**/ ?>