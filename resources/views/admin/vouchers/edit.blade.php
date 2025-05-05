@extends('admin.layouts.master')

@section('item-voucher', 'open')
@section('item-voucher-index', 'active')
@section('content')
    <div class="container mt-5">
        <div class="mb-4 text-center">
            <h1 class="fw-bold text-primary">✏️ Chỉnh sửa Voucher</h1>
            <p class="text-muted">Cập nhật thông tin voucher cho khách hàng.</p>
        </div>

        <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        {{-- Mã Voucher --}}
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Mã Voucher</label>
                            <input type="text" name="code" class="form-control"
                                value="{{ old('code', $voucher->code) }}" placeholder="Nhập mã voucher">
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tên Voucher --}}
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên Voucher</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $voucher->name) }}" placeholder="Nhập tên voucher">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Loại Giảm Giá --}}
                        <div class="col-md-6 mb-3">
                            <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                            <select name="discount_type" id="discount_type" class="form-control">
                                <option value="fixed"
                                    {{ old('discount_type', $voucher->discount_type) == 'fixed' ? 'selected' : '' }}>Cố định
                                    (VNĐ)</option>
                                <option value="percentage"
                                    {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'selected' : '' }}>
                                    Phần trăm (%)</option>
                            </select>
                            @error('discount_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Giá Trị Giảm Giá --}}
                        <div class="col-md-6 mb-3">
                            <label for="discount_value" class="form-label">
                                Giá Trị Giảm Giá (<span id="discount_label">VNĐ</span>)
                            </label>
                            <input type="number" name="discount_value" class="form-control"
                                value="{{ old('discount_value', $voucher->discount_value) }}" min="0">
                            @error('discount_value')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Giá trị đơn hàng tối thiểu --}}
                        <div class="col-md-6 mb-3">
                            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                            <input type="number" name="min_order_value" class="form-control"
                                value="{{ old('min_order_value', $voucher->min_order_value) }}">
                            @error('min_order_value')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Giá trị giảm giá tối đa --}}
                        <div class="col-md-6 mb-3" id="max_discount_group">
                            <label for="max_discount_value" class="form-label">Giảm Giá Tối Đa (VNĐ)</label>
                            <input type="number" name="max_discount_value" class="form-control"
                                value="{{ old('max_discount_value', $voucher->max_discount_value) }}" min="0">
                            @error('max_discount_value')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ngày bắt đầu --}}
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ old('start_date', $voucher->start_date) }}">
                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ngày hết hạn --}}
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Ngày Hết Hạn</label>
                            <input type="date" name="end_date" class="form-control"
                                value="{{ old('end_date', $voucher->end_date) }}">
                            @error('end_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Số lượng --}}
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control"
                                value="{{ old('quantity', $voucher->quantity) }}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Trạng thái --}}
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>
                                    Hoạt động</option>
                                
                                <option value="disabled"
                                    {{ old('status', $voucher->status) == 'disabled' ? 'selected' : '' }}>Vô hiệu hóa
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhật Voucher</button>
                        <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script-libs')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
            maxDiscountGroup.style.display = (type === 'percentage') ? 'block' : 'none';
            discountLabel.textContent = (type === 'percentage') ? '%' : 'VNĐ';
        }

        function validateDiscountValue() {
            const type = discountType.value;
            let value = parseFloat(discountValue.value);
            let valid = true;

            if (isNaN(value)) {
                createError(discountValue, 'Vui lòng nhập giá trị giảm.');
                valid = false;
            } else if (type === 'percentage') {
                if (value > 90) {
                    discountValue.value = 90;
                    createError(discountValue, 'Giá trị phần trăm đã tự động giới hạn ở 90%.');
                } else if (value <= 0) {
                    createError(discountValue, 'Giá trị phần trăm phải lớn hơn 0%.');
                    valid = false;
                } else {
                    clearError(discountValue);
                }
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
            return [
                validateDiscountValue(),
                validateMinOrder(),
                validateQuantity(),
                validateDates()
            ].every(v => v);
        }

        // Event bindings
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

        form.addEventListener('submit', function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });

        toggleMaxDiscount(); // Initial run
    });
</script>

@endsection
