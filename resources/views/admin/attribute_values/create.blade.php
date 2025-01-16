@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">ThUỘC TÍNH /</span> THÊM THUỘC TÍNH
        </h4>

        <div class="app-ecommerce-category">
            <!-- Add Attribute Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thêm Thuộc Tính</h5>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-danger fw-bold">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('attribute-values.store') }}" method="POST"
                        class="p-4 border rounded shadow-sm bg-white">
                        @csrf
                        <h5 class="mb-4">Thêm Giá Trị Thuộc Tính</h5>
                        <!-- Nút hành động -->
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-check-circle-outline me-1"></i> Xuất bản
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="mdi mdi-reload me-1"></i> Nhập lại
                            </button>
                            <a href="{{ route('attribute-values.index') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>
                        <!-- Dropdown chọn thuộc tính -->
                        <div class="mb-3">
                            <label for="attributes_name_id" class="form-label">Tên Thuộc Tính</label>
                            <select name="attributes_name_id" id="attributes_name_id" class="form-select">
                                <option value="" disabled selected>Chọn thuộc tính</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                            @error('attributes_name_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input giá trị thuộc tính -->
                        <div class="mb-3">
                            <label for="value" class="form-label">Giá Trị</label>
                            <input type="text" name="value" id="value" class="form-control"
                                placeholder="Nhập giá trị">
                            @error('value')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        @endsection
