@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Thuộc tính /</span> Cập nhật thuộc tính
        </h4>

        <div class="app-ecommerce-category">
            <!-- Add Attribute Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Cập nhật thuộc tính</h5>
                </div>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('attributes.update', $attribute->id) }}" method="POST"
                        class="p-4 border rounded shadow-sm bg-white">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-end align-items-center gap-3 ">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-check-circle-outline me-1"></i> Cập nhật
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="mdi mdi-reload me-1"></i> Nhập lại
                            </button>
                            <a href="{{ route('attributes.index') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>
                        <!-- Tên Thuộc Tính -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Thuộc Tính</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $attribute->name }}" placeholder="Nhập tên thuộc tính">
                        </div>
                    </form>

                </div>
            </div>
        @endsection
