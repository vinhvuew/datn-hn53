@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Chỉnh Sửa Thương Hiệu</h1>

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên Thương Hiệu</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="text" name="text" rows="3">{{ $brand->text }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
@endsection


