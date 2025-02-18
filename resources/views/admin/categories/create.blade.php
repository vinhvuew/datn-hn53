@extends('admin.layouts.master')

@section('item-category', 'open')

@section('item-category-create', 'active')

@section('content')
<<<<<<< HEAD
<div class="container mt-5">
    <h1>Thêm Danh Mục</h1>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}"> 
            @error('name')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form> 
</div>
=======
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Danh mục /</span> Thêm mới danh mục
            </h4>

            <div class="app-ecommerce-category">
                <!-- Search Bar and Add Category Button in a Single Row -->
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <a href="{{ route('category.index') }}" class="btn btn-info">
                        Quay lại
                    </a>
                </div>

                <div class="row">
                    <!-- Category List Table -->
                    <div class="card">
                        <div class="card-datatable table-responsive">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Danh Mục</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}">
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
>>>>>>> 73edc2211242ae6e934b743def6c0ebf86efdb54
@endsection
