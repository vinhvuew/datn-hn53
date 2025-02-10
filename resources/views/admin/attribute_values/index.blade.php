@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">GIÁ TRỊ THUỘC TÍNH /</span> DANH SÁCH GIÁ TRỊ THUỘC TÍNH
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
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
                    <a class="btn btn-primary me-2" href="{{ route('attribute-values.create') }}">
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        + THÊM GIÁ TRỊ THUỘC TÍNH</a>
                </div>
            </div>

            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table border-top table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>TÊN THUỘC TÍNH</th>
                                <th>GIÁ TRỊ THUỘC TÍNH</th>
                                <th>HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($values as $value)
                                <!-- Placeholder Rows -->
                                <tr class="text-center">
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->attribute->name }}</td>
                                    <td>{{ $value->value }}</td>
                                    <td>

                                        <a href="{{ route('attribute-values.edit', $value->id) }}"
                                            class="btn btn-warning">Sửa</a>
                                        <form action="{{ route('attribute-values.destroy', $value->id) }}" method="POST"
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
@endsection
