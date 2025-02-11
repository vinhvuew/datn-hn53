@extends('admin.layouts.master')

@section('item-brand', 'open')
@section('item-brand-create', 'active')

@section('content')
    <div class="container mt-5">
        <h1>Thêm Thương Hiệu</h1>

        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên Thương Hiệu</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="text" name="text" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection
