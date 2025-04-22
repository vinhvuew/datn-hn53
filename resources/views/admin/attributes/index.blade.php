@extends('admin.layouts.master')
@section('item-atribute', 'open')

@section('item-atribute-index', 'active')
@section('content')
    <!-- Content wrapper -->
    <!-- Content -->
    <div class="container mt-5">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Thuộc Tính /</span> Danh Sách Thuộc Tính
        </h4>

        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- Category List Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center">
                <a class="btn btn-primary me-2" href="{{ route('attributes.create') }}">
                    <i class="mdi mdi-plus me-0 me-sm-1"></i>
                    + THÊM THUỘC TÍNH</a>
            </div>
            <div class="card-body">
                <table id="example"
                    class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>TÊN THUỘC TÍNH</th>
                            <th>NGÀY ĐĂNG</th>
                            <th>NGÀY CẬP NHẬT</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $attribute)
                            <!-- Placeholder Rows -->
                            <tr class="text-center">
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->created_at }}</td>
                                <td>{{ $attribute->updated_at }}</td>
                                <td>

                                    <a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-warning">Sửa</a>
                                    {{-- <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- / Content -->

    <!-- Footer -->
    <div class="content-backdrop fade"></div>
    <!-- Content wrapper -->
@endsection
@include('admin.layouts.parials.datatable')
