@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vouchers</span> 
    </h4>

    <div class="app-ecommerce-category">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-title mb-0">Danh sách Vouchers</h5>
                <a href="" class="btn btn-primary">Thêm mới</a>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-category-list table border-top">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã Voucher</th>
                            <th>Tên Voucher</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th class="text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->id }}</td>
                                <td>{{ $voucher->voucher }}</td>
                                <td>{{ $voucher->name }}</td>
                                <td>{{ $voucher->valid_from }}</td>
                                <td>{{ $voucher->valid_to }}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
