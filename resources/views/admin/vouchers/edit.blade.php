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
        <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $voucher->code) }}"
                            placeholder="Nhập mã voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Tên Voucher</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $voucher->name) }}"
                            placeholder="Nhập tên voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_type">Loại Giảm Giá</label>
                        <select name="discount_type" id="discount_type" class="form-control" required>
                            <option value="percentage"
                                {{ old('discount_type', $voucher->discount_type ?? '') == 'percentage' ? 'selected' : '' }}>
                                Phần trăm</option>
                            <option value="fixed"
                                {{ old('discount_type', $voucher->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>Cố
                                định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giảm Giá</label>
                        <input type="number" step="0.001" name="discount_value" id="discount_value" class="form-control"
                            value="{{ old(
                                'discount_value',
                                isset($voucher)
                                    ? ($voucher->discount_type == 'percentage'
                                        ? number_format($voucher->discount_value, 0, '.', '') // Phần trăm có 0 chữ số thập phân
                                        : number_format($voucher->discount_value, 3, '.', '')) // Cố định có 3 chữ số thập phân
                                    : '',
                            ) }}"
                            placeholder="Nhập giá trị giảm giá" required min="0">
                        <small id="discount_error" class="text-danger d-none">Phần trăm giảm giá không thể lớn hơn
                            90%.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="min_order_value">Điều kiện áp dụng</label>
                        <input type="number" name="min_order_value" id="min_order_value" class="form-control"
                            value="{{ number_format($voucher->min_order_value, 3) }}"
                            placeholder="Nhập giá trị đơn hàng tối thiểu" required min="0">
                        <small id="order_error" class="text-danger d-none">Giá trị đơn hàng phải lớn hơn giá trị giảm
                            giá.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">số lượng</label>
                        <input type="text" name="max_discount_value" class="form-control"
                            value="{{ old('max_discount_value', number_format($voucher->max_discount_value, 0)) }}"
                            placeholder="Nhập tên voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>Hoạt
                                động</option>
                            <option value="expired" {{ old('status', $voucher->status) == 'expired' ? 'selected' : '' }}>
                                Hết
                                hạn</option>
                            <option value="disabled" {{ old('status', $voucher->status) == 'disabled' ? 'selected' : '' }}>
                                Vô hiệu hóa</option>
                        </select>
                    </div>

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
@endsection
