@extends('admin.layouts.master')
@section('item-category', 'open')
@section('item-category-index', 'active')
@section('content')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Danh mục /</span> Chỉnh sửa danh mục
            </h4>

            <div class="app-ecommerce-category">
                <!-- Search Bar and Add Category Button in a Single Row -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Search Bar -->
                    <div style="width: 25%;" class="me-2">
                        <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." />
                    </div>
                    <!-- Add Category Button -->
                    <a href="{{ route('category.index') }}" class="btn btn-info">
                        Quay lại
                    </a>
                </div>

                @if (session('categorySuccess'))
                    <div class="alert alert-success">
                        {{ session('categorySuccess') }}
                    </div>
                @endif

                <div class="row">
                    <!-- Category List Table -->
                    <div class="card">
                        <div class="card-datatable table-responsive">
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Danh Mục</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $category->name) }}">
                                    @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mb-3">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

@endsection
