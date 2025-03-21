@extends('client.layouts.master')

@section('content')
<main>

<div class="container mt-4">
    <h1 class="text-center mb-4">Danh Sách Tin Tức</h1>

    <div class="row">
        @foreach ($news as $item)
            <div class="col-md-12">
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        @if ($item->image)
                            <div class="col-md-4">
                                <img src="{{ Storage::url($item->image) }}" width="400px" alt="vip">


                            </div>
                        @endif
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('news.shows', $item->id) }}" class="text-decoration-none text-dark">
                                        {{ $item->title }}
                                    </a>
                                </h5>
                                <p class="text-muted">
                                    Ngày đăng: {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : 'Không có thông tin' }}
                                </p>
                                <a href="{{ route('news.shows', $item->id) }}" class="btn btn-primary btn-sm">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</main>
@endsection
