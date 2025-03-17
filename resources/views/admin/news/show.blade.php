@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4">
        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top img-fluid rounded-top-4" alt="Hình ảnh bài viết">
        @endif
        <div class="card-body">
            <h1 class="card-title text-gradient fw-bold">{{ $news->title }}</h1>
            <p class="text-muted">
                📅 Ngày đăng: <strong>{{ optional($news->created_at)->format('d/m/Y H:i') }}</strong>
            </p>
            <hr>
            <p class="card-text fs-5 text-dark">{{ $news->content }}</p>
            <a href="{{ route('news.index') }}" class="btn btn-secondary mt-3 btn-hover">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
</div>
@endsection
