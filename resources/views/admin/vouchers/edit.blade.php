@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Sửa Voucher</h1>

        <!-- Thông báo lỗi hoặc thành công (nếu có) -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form sửa voucher -->
        <form id="voucherForm" action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                    {{-- Mã Voucher --}}
                    <div class="form-group mb-3">
                        <label for="code" class="form-label">Mã Voucher</label>
                        <input type="text" name="code" id="code" class="form-control"
                            value="{{ old('code', $voucher->code) }}" placeholder="Nhập mã voucher" required>
                        <small class="text-danger d-none" id="code_error">Mã voucher không được để trống.</small>
                    </div>

                    {{-- Tên Voucher --}}
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Tên Voucher</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $voucher->name) }}" placeholder="Nhập tên voucher" required>
                        <small class="text-danger d-none" id="name_error">Tên voucher không được để trống.</small>
                    </div>

                    {{-- Loại Giảm Giá --}}
                    <div class="form-group mb-3">
                        <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                        <select name="discount_type" id="discount_type" class="form-control" required>
                            <option value="percentage"
                                {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'selected' : '' }}>Phần
                                trăm (%)</option>
                            <option value="fixed"
                                {{ old('discount_type', $voucher->discount_type) == 'fixed' ? 'selected' : '' }}>Cố định
                                (VNĐ)</option>
                        </select>
                    </div>

                    {{-- Giá trị giảm giá --}}
                    <div class="form-group mb-3">
                        <label for="discount_value" class="form-label">Giá Trị Giảm Giá</label>
                        <input type="number" name="discount_value" id="discount_value" class="form-control"
                            value="{{ old('discount_value', $voucher->discount_value) }}"
                            placeholder="Nhập giá trị giảm giá" required min="0">
                        <small class="text-danger d-none" id="discount_value_error">Giá trị giảm giá không hợp lệ.</small>
                    </div>

                    {{-- Điều kiện áp dụng --}}
                    <div class="form-group mb-3">
                        <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                        <input type="number" name="min_order_value" id="min_order_value" class="form-control"
                            value="{{ old('min_order_value', $voucher->min_order_value) }}"
                            placeholder="Nhập giá trị đơn hàng tối thiểu" required min="0">
                        <small class="text-danger d-none" id="min_order_value_error">Giá trị đơn hàng tối thiểu phải lớn hơn
                            giá trị giảm giá.</small>
                    </div>

                    {{-- Giảm giá tối đa --}}
                    <div class="form-group mb-3" id="max_discount_value_group"
                        style="display: {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'block' : 'none' }};">
                        <label for="max_discount_value" class="form-label">Giảm Giá Tối Đa (VNĐ)</label>
                        <input type="number" name="max_discount_value" id="max_discount_value" class="form-control"
                            value="{{ old('max_discount_value', $voucher->max_discount_value ?? '') }}"
                            placeholder="Nhập giá trị giảm giá tối đa" min="0">
                        <small id="max_discount_value_error" class="text-danger d-none">Giảm giá tối đa phải lớn hơn giá trị
                            giảm giá!</small>
                    </div>

                    {{-- Ngày Bắt Đầu --}}
                    <div class="form-group mb-3">
                        <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ old('start_date', $voucher->start_date) }}">
                    </div>

                    {{-- Ngày Hết Hạn --}}
                    <div class="form-group mb-3">
                        <label for="end_date" class="form-label">Ngày Hết Hạn</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ old('end_date', $voucher->end_date) }}">
                        <small class="text-danger d-none" id="end_date_error">Ngày hết hạn phải sau ngày bắt đầu.</small>
                    </div>

                    {{-- Trạng thái --}}
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>Hoạt
                                động</option>
                            <option value="expired" {{ old('status', $voucher->status) == 'expired' ? 'selected' : '' }}>
                                Hết hạn</option>
                            <option value="disabled"
                                {{ old('status', $voucher->status) == 'disabled' ? 'selected' : '' }}>
                                Vô hiệu hóa</option>
                        </select>
                    </div>

                    {{-- Nút bấm --}}
                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('script-libs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.getElementById("voucherForm");
            let discountType = document.getElementById("discount_type");
            let maxDiscountGroup = document.getElementById("max_discount_value_group");
            let maxDiscountValue = document.getElementById("max_discount_value");
            let discountValue = document.getElementById("discount_value");
            let minOrderValue = document.getElementById("min_order_value");
            let startDate = document.getElementById("start_date");
            let endDate = document.getElementById("end_date");

            // Các trường cần kiểm tra lỗi
            let errors = {
                code: document.getElementById("code_error"),
                name: document.getElementById("name_error"),
                discount_value: document.getElementById("discount_value_error"),
                min_order_value: document.getElementById("min_order_value_error"),
                max_discount_value: document.getElementById("max_discount_value_error"),
                end_date: document.getElementById("end_date_error"),
            };

            // Ẩn/hiện giảm giá tối đa theo loại giảm giá
            function toggleMaxDiscount() {
                if (discountType.value === "percentage") {
                    maxDiscountGroup.style.display = "block";
                } else {
                    maxDiscountGroup.style.display = "none";
                    maxDiscountValue.value = ""; // Reset giá trị khi ẩn
                }
            }

            // Kiểm tra lỗi trước khi gửi biểu mẫu
            form.addEventListener("submit", function(event) {
                let valid = true;

                // Xóa thông báo lỗi trước đó
                Object.values(errors).forEach((error) => error.classList.add("d-none"));

                // Kiểm tra mã và tên voucher
                ["code", "name"].forEach((field) => {
                    let input = document.getElementById(field);
                    if (!input.value.trim()) {
                        errors[field].classList.remove("d-none");
                        valid = false;
                    }
                });

                // Kiểm tra giá trị giảm giá
                if (discountValue.value <= 0) {
                    errors.discount_value.classList.remove("d-none");
                    valid = false;
                }

                // Kiểm tra đơn hàng tối thiểu lớn hơn giảm giá
                if (parseFloat(minOrderValue.value) < parseFloat(discountValue.value)) {
                    errors.min_order_value.classList.remove("d-none");
                    valid = false;
                }

                // Kiểm tra giảm giá tối đa nếu chọn giảm theo %
                if (discountType.value === "percentage" && maxDiscountValue.value) {
                    if (parseFloat(maxDiscountValue.value) < parseFloat(discountValue.value)) {
                        errors.max_discount_value.classList.remove("d-none");
                        valid = false;
                    }
                }

                // Kiểm tra ngày hết hạn phải sau ngày bắt đầu
                if (startDate.value && endDate.value && startDate.value >= endDate.value) {
                    errors.end_date.classList.remove("d-none");
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault(); // Ngăn gửi biểu mẫu nếu có lỗi
                }
            });

            // Sự kiện thay đổi loại giảm giá
            discountType.addEventListener("change", toggleMaxDiscount);

            toggleMaxDiscount(); // Gọi khi trang tải
        });
    </script>
@endsection
