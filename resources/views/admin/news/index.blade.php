@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-gradient fw-bold">
            <i class="fas fa-newspaper"></i> Quản Lý Tin Tức
        </h2>
        <a href="{{ route('news.create') }}" class="btn btn-success shadow-lg px-4 py-2 btn-hover">
            <i class="fas fa-plus-circle"></i> Thêm Tin Tức
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($listNews as $news)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg border-0 rounded-4 card-hover">
                    <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/300' }}"
                         class="card-img-top rounded-top-4 img-hover" height="200" style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                        <div class="text-muted small">
                            📅 Ngày tạo: <strong>{{ optional($news->created_at)->format('d/m/Y H:i') }}</strong> <br>
                            ✏️ Ngày sửa: <strong>{{ optional($news->updated_at)->format('d/m/Y H:i') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('news.show', $news->id) }}" class="btn btn-info btn-sm px-3 btn-hover">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning btn-sm px-3 btn-hover">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('news.destroy', $news->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3 btn-hover"
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
    /* Gradient text đẹp hơn */
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Hiệu ứng hover cho card */
    .card-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Hiệu ứng hover cho ảnh */
    .img-hover {
        transition: transform 0.3s ease-in-out;
    }
    .img-hover:hover {
        transform: scale(1.05);
    }

    /* Hiệu ứng hover cho button */
    .btn-hover {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .btn-hover:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 12px rgba(0, 123, 255, 0.5);
    }

    /* Hiệu ứng thông báo */
    .custom-alert {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Bo góc card */
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
@endsection
