@extends('admin.layouts.master')

@section('item-brand', 'open')
@section('item-brand-index', 'active')
@section('content')
<<<<<<< HEAD
<div class="container mt-5">
    <h1>Danh Sách Thương Hiệu</h1>
    <a href="{{ route('admin.brands.create') }}">Thêm Thương Hiệu</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô Tả</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
=======
    <div class="container mt-5">
        <h1>Danh Sách Thương Hiệu</h1>
        <a class="btn btn-primary mb-3" href="{{ route('brands.create') }}">Thêm Thương Hiệu</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary text-center">
>>>>>>> 73edc2211242ae6e934b743def6c0ebf86efdb54
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td class="text-center align-middle">{{ $brand->id }}</td>
                        <td class="align-middle">{{ $brand->name }}</td>
                        <td class="align-middle">{{ $brand->text }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
