@extends('admin.layouts.master')
@section('item-atribute', 'open')

@section('item-atribute-index', 'active')
@section('content')
    <!-- Content wrapper -->
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Atributes /</span> Atributes List
        </h4>

        <div class="app-ecommerce-category">
            <!-- Search Bar and Add Category Button in a Single Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Search Bar -->
                <div style="width: 25%;" class="me-2">
                    <input type="text" id="searchCategory" class="form-control" placeholder="Search attibutes . .." />
                </div>
                <!-- Add Category Button -->
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasEcommerceCategoryList" aria-controls="offcanvasEcommerceCategoryList">
                    + Add Atributes
                </button> --}}
                <div class="card-header d-flex justify-content-end align-items-center">
                    <a class="btn btn-primary me-2" href="{{ route('attributes.create') }}">
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        + THÊM THUỘC TÍNH</a>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success fw-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table border-top table-hover table-bordered">
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

                                        <a href="{{ route('attributes.edit', $attribute->id) }}"
                                            class="btn btn-warning">Sửa</a>
                                        <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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
    <!-- / Content -->

    <!-- Footer -->
    <div class="content-backdrop fade"></div>
    <!-- Content wrapper -->
@endsection
