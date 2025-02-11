@extends('admin.layouts.master')

@section('item-brand', 'open')
@section('item-brand-index', 'active')
@section('content')
    <div class="container mt-5">
        <h1>Danh Sách Thương Hiệu</h1>
        <a href="{{ route('brands.create') }}">Thêm Thương Hiệu</a>
        @if (session('success'))
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
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->text }}</td>
                        <td>
                            <a href="{{ route('brands.edit', $brand) }}">Sửa</a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
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
