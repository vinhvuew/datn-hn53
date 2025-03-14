@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fas fa-plus-circle"></i> Thêm Tin Tức Mới
        </h2>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Trở lại</a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Hình ảnh</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                    <textarea name="content" id="editor" class="form-control" required></textarea>
                </div>



                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Lưu</button>
                    <a href="{{ route('news.index') }}" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection
