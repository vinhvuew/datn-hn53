@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
        </h2>
        <a href="{{ route('news.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle"></i> Thêm Tin Tức
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($listNews as $news)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/300' }}"
                         class="card-img-top rounded-top" height="200" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                        <p class="text-muted small">Ngày tạo: {{ optional($news->created_at)->format('d/m/Y H:i') }}</p>
                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a> --}}
                            <form action="{{ route('news.destroy', $news->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Xác nhận xóa tin này?')">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('style-libs')
<style>
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endsection
