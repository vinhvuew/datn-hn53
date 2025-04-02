@extends('client.layouts.master')

@section('content')
<main>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
            @if ($news->image)
            <div class="text-center w-100" style="max-width: 100%;">
             <img src="{{ asset('storage/' . $news->image) }}" class="rounded img-fluid" 
              style="width: 100%; height: auto; max-height: 400px; object-fit: cover;">
            </div>
            @endif

                <div class="card-body p-4">
                    <h1 class="card-title text-center fw-bold">{{ $news->title }}</h1>
                    <p class="text-muted text-center">
                        <i class="fas fa-calendar-alt"></i> 
                        Ngày đăng: {{ $news->created_at ? $news->created_at->format('d/m/Y H:i') : 'Không có thông tin' }}
                    </p>
                    <hr>
                    <p class="card-text text-justify fs-5">{{ $news->content }}</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('news') }}" class="btn btn-secondary btn-lg px-4">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
