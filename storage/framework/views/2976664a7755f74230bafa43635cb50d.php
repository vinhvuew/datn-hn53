<?php $__env->startSection('item-voucher', 'open'); ?>
<?php $__env->startSection('item-voucher-creat', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        
        <div class="mb-4 text-center">
            <h1 class="fw-bold text-primary">🎁 Tạo Voucher Mới</h1>
            <p class="text-muted">Điền đầy đủ thông tin để tạo một voucher mới cho khách hàng.</p>
        </div>

        <form action="<?php echo e(route('vouchers.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Mã Voucher</label>
                            <input type="text" name="code" class="form-control" value="<?php echo e(old('code')); ?>"
                                placeholder="Nhập mã voucher">
                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên Voucher</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>"
                                placeholder="Nhập tên voucher">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                            <select name="discount_type" id="discount_type" class="form-control">
                                <option value="fixed" <?php echo e(old('discount_type') == 'fixed' ? 'selected' : ''); ?>>Cố định (VNĐ)
                                </option>
                                <option value="percentage" <?php echo e(old('discount_type') == 'percentage' ? 'selected' : ''); ?>>Phần
                                    trăm (%)</option>
                            </select>
                            <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="discount_value" class="form-label">
                                Giá Trị Giảm Giá (<span id="discount_label">VNĐ</span>)
                            </label>
                            <input type="number" name="discount_value" class="form-control"
                                value="<?php echo e(old('discount_value')); ?>" min="0">
                            <?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                            <input type="number" name="min_order_value" class="form-control"
                                value="<?php echo e(old('min_order_value')); ?>">
                            <?php $__errorArgs = ['min_order_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3" id="max_discount_group">
                            <label for="max_discount_value" class="form-label">Giảm Giá Tối Đa (VNĐ)</label>
                            <input type="number" name="max_discount_value" class="form-control"
                                value="<?php echo e(old('max_discount_value')); ?>" min="0">
                            <?php $__errorArgs = ['max_discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>">
                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Ngày Hết Hạn</label>
                            <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date')); ?>">
                            <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="<?php echo e(old('quantity')); ?>">
                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
                                <option value="disabled" <?php echo e(old('status') == 'disabled' ? 'selected' : ''); ?>>Vô hiệu hóa
                                </option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="text-end mt-3">
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const discountType = document.getElementById('discount_type');
            const maxDiscountGroup = document.getElementById('max_discount_group');
            const discountLabel = document.getElementById('discount_label');

            const discountValue = document.querySelector('input[name="discount_value"]');
            const minOrderValue = document.querySelector('input[name="min_order_value"]');
            const maxDiscountValue = document.querySelector('input[name="max_discount_value"]');
            const quantity = document.querySelector('input[name="quantity"]');
            const startDate = document.querySelector('input[name="start_date"]');
            const endDate = document.querySelector('input[name="end_date"]');

            function createError(input, message) {
                let error = input.parentElement.querySelector('.text-danger.client');
                if (!error) {
                    error = document.createElement('small');
                    error.classList.add('text-danger', 'client');
                    input.parentElement.appendChild(error);
                }
                error.textContent = message;
                error.style.display = 'block';
            }

            function clearError(input) {
                const error = input.parentElement.querySelector('.text-danger.client');
                if (error) {
                    error.style.display = 'none';
                    error.textContent = '';
                }
            }

            function toggleMaxDiscount() {
                const type = discountType.value;
                if (type === 'percentage') {
                    maxDiscountGroup.style.display = 'block';
                    discountLabel.textContent = '%';
                } else {
                    maxDiscountGroup.style.display = 'none';
                    discountLabel.textContent = 'VNĐ';
                }
            }

            function validateDiscountValue() {
                const type = discountType.value;
                const value = parseFloat(discountValue.value);
                let valid = true;

                if (isNaN(value)) {
                    createError(discountValue, 'Vui lòng nhập giá trị giảm.');
                    valid = false;
                } else if (type === 'percentage' && value > 90) {
                    createError(discountValue, 'Giá trị phần trăm không được lớn hơn 90%.');
                    valid = false;
                } else {
                    clearError(discountValue);
                }

                return valid;
            }

            function validateMinOrder() {
                const type = discountType.value;
                const discount = parseFloat(discountValue.value);
                const minOrder = parseFloat(minOrderValue.value);
                let valid = true;

                if (type === 'fixed' && !isNaN(discount) && !isNaN(minOrder) && discount > minOrder) {
                    createError(minOrderValue, 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng giá trị giảm.');
                    valid = false;
                } else {
                    clearError(minOrderValue);
                }

                return valid;
            }

            function validateQuantity() {
                const value = parseInt(quantity.value);
                let valid = true;

                if (!value || value < 1) {
                    createError(quantity, 'Số lượng phải lớn hơn 0.');
                    valid = false;
                } else {
                    clearError(quantity);
                }

                return valid;
            }

            function validateDates() {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                let valid = true;

                if (startDate.value && endDate.value && end < start) {
                    createError(endDate, 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.');
                    valid = false;
                } else {
                    clearError(endDate);
                }

                return valid;
            }

            function validateForm() {
                const validations = [
                    validateDiscountValue(),
                    validateMinOrder(),
                    validateQuantity(),
                    validateDates()
                ];
                return validations.every(v => v);
            }

            // Event listeners
            discountType.addEventListener('change', () => {
                toggleMaxDiscount();
                validateDiscountValue();
                validateMinOrder();
            });

            discountValue.addEventListener('input', () => {
                validateDiscountValue();
                validateMinOrder();
            });

            minOrderValue.addEventListener('input', validateMinOrder);
            quantity.addEventListener('input', validateQuantity);
            startDate.addEventListener('change', validateDates);
            endDate.addEventListener('change', validateDates);

            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });

            toggleMaxDiscount(); // initial call
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/vouchers/create.blade.php ENDPATH**/ ?>