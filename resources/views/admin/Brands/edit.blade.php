@extends('admin.layouts.master')

@section('item-brand', 'open')
@section('item-brand-index', 'active')

@section('content')
    <div class="container mt-5">
        <h1>Chỉnh Sửa Thương Hiệu</h1>

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('brands.update', $brand) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên Thương Hiệu</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                    id="name" name="name" value="{{ old('name', $brand->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Mô Tả</label>
                <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3">{{ old('text', $brand->text) }}</textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@endsection
