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
                        <select name="discount_type" class="form-control" required>
                            <option value="percentage">Phần trăm</option>
                            <option value="fixed">Cố định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giảm Giá</label>
                        <input type="number" name="discount_value" class="form-control" placeholder="Nhập giá trị giảm giá" required>
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
