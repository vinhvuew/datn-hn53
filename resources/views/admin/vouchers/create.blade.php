@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tạo Voucher Mới</h1>

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

        <!-- Form tạo voucher -->
        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf
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
                            <option value="percentage">Phần trăm</option>
                            <option value="fixed">Cố định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giảm Giá</label>
                        <input type="number" name="discount_value" id="discount_value" class="form-control"
                            placeholder="Nhập giá trị giảm giá" required min="0">
                        <small id="discount_error" class="text-danger d-none">Phần trăm giảm giá không thể lớn hơn
                            90%.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="min_order_value">Giá trị đơn hàng tối thiểu</label>
                        <input type="number" name="min_order_value" id="min_order_value" class="form-control"
                            placeholder="Giá trị đơn hàng" required min="0">
                        <small id="order_error" class="text-danger d-none">Giá trị đơn hàng phải lớn hơn giá trị giảm
                            giá.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">số lượng</label>
                        <input type="number" name="max_discount_value" class="form-control" placeholder="Nhập số lượng"
                            required>
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

            discountValue.addEventListener("input", function() {
                if (discountType.value === "percentage" && this.value > 90) {
                    this.value = 90;
                    discountError.classList.remove("d-none"); // Hiển thị cảnh báo
                } else {
                    discountError.classList.add("d-none"); // Ẩn cảnh báo nếu hợp lệ
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const discountValue = document.getElementById("discount_value");
            const minOrderValue = document.getElementById("min_order_value");
            const orderError = document.getElementById("order_error");

            // Kiểm tra điều kiện min_order_value > discount_value
            function validateOrderValue() {
                if (parseFloat(minOrderValue.value) <= parseFloat(discountValue.value)) {
                    orderError.classList.remove("d-none"); // Hiển thị lỗi
                } else {
                    orderError.classList.add("d-none"); // Ẩn lỗi nếu hợp lệ
                }
            }

            // Lắng nghe sự kiện input khi thay đổi giá trị
            discountValue.addEventListener("input", validateOrderValue);
            minOrderValue.addEventListener("input", validateOrderValue);
        });
    </script>
@endsection
