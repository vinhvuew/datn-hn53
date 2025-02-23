@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách Voucher</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Nút tạo voucher mới -->
        <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">Tạo Voucher Mới</a>

        <!-- Bảng danh sách voucher -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Tên</th>
                            <th>Giảm giá</th>
                            <th>điều kiện áp dụng</th>
                            <th>số lượng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ $voucher->name }}</td>
                                <td>
                                    {{ $voucher->discount_type == 'percentage'
                                        ? number_format($voucher->discount_value) . '%'
                                        : number_format($voucher->discount_value, 3) . ' VND' }}
                                </td>
                                <td>{{ number_format($voucher->min_order_value, 3) . ' VND' }}</td>
                                <td>{{ number_format($voucher->max_discount_value, 0) }}</td>
                                <td>
                                    <span
                                        class="badge {{ $voucher->status == 'active' ? 'bg-success' : ($voucher->status == 'expired' ? 'bg-danger' : 'bg-secondary') }}">
                                        {{ ucfirst($voucher->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('vouchers.edit', $voucher->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
