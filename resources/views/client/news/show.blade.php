@extends('client.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        @if ($news->image)
        <img src="{{ Storage::url($news->image) }}" class="card-img-top"  width="40px" height="auto">

        @endif
        <div class="card-body">
            <h1 class="card-title">{{ $news->title }}</h1>
            <p class="text-muted">
                Ngày đăng: {{ $news->created_at ? $news->created_at->format('d/m/Y H:i') : 'Không có thông tin' }}
            </p>
            <p class="card-text">{{ $news->content }}</p>
            <a href="{{ url('/news') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </div>
    </div>
</div>
@endsection
