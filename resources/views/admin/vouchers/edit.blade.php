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
                        <input type="text" name="code" class="form-control" value="{{ old('code', $voucher->code) }}" placeholder="Nhập mã voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Tên Voucher</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $voucher->name) }}" placeholder="Nhập tên voucher" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_type">Loại Giảm Giá</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="percentage" {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
                            <option value="fixed" {{ old('discount_type', $voucher->discount_type) == 'fixed' ? 'selected' : '' }}>Cố định</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_value">Giảm Giá</label>
                        <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $voucher->discount_value) }}" placeholder="Nhập giá trị giảm giá" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="expired" {{ old('status', $voucher->status) == 'expired' ? 'selected' : '' }}>Hết hạn</option>
                            <option value="disabled" {{ old('status', $voucher->status) == 'disabled' ? 'selected' : '' }}>Vô hiệu hóa</option>
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
