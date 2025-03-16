@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-gradient fw-bold">
            <i class="fas fa-newspaper"></i> Thêm Tin Tức Mới
        </h2>
        <a href="{{ route('news.index') }}" class="btn btn-outline-dark fw-bold shadow-sm px-4 py-2">
            <i class="fas fa-arrow-left"></i> Trở lại
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4 bg-white">
        <div class="card-header text-white fw-bold text-center rounded-top-4 py-3"
            style="background: linear-gradient(135deg, #007bff, #6610f2); font-size: 1.25rem;">
            <i class="fas fa-edit"></i> Nhập thông tin bài viết
        </div>

        <div class="card-body p-4">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">📌 Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title"
                        class="form-control shadow-sm border-1 rounded-3 p-3 input-focus"
                        placeholder="Nhập tiêu đề bài viết" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">🖼 Hình ảnh</label>
                    <input type="file" name="image"
                        class="form-control shadow-sm border-1 rounded-3 p-3 input-focus">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold fs-5 text-dark">📝 Nội dung <span class="text-danger">*</span></label>
                    <div class="border rounded-4 shadow-sm p-3 bg-light">
                        <textarea name="content" id="editor"
                            class="form-control border-0 bg-white rounded-3 p-3 text-area-focus"
                            placeholder="Nhập nội dung bài viết..." required></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success fw-bold px-5 py-2 shadow-lg btn-hover">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('news.index') }}" class="btn btn-danger fw-bold px-5 py-2 shadow-lg btn-hover ms-2">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS Tùy Chỉnh -->
<style>
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .input-focus:focus {
        border-color: #6610f2 !important;
        box-shadow: 0px 0px 8px rgba(102, 16, 242, 0.5) !important;
    }

    .text-area-focus:focus {
        border-color: #007bff !important;
        box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.5) !important;
    }

    .btn-hover:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 300,
            removePlugins: 'elementspath',
            resize_enabled: false
        });
    </script>
@endsection
