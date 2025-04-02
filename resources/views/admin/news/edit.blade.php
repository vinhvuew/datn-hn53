@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fas fa-edit"></i> Chỉnh Sửa Tin Tức
        </h2>
        <a href="{{ route('news.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Quay Lại
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Nội dung</label>
                            <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content', $news->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Hình ảnh</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($news->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="Hình hiện tại" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="fas fa-save"></i> Cập Nhật
                            </button>
                            <a href="{{ route('news.index') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
