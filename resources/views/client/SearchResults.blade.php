@extends('client.layouts.master')

@section('content')
<div class="container">
    <h2 class="mt-4">Kết quả tìm kiếm cho: "{{ $query }}"</h2>

    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $product->img_thumbnail) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</p>
                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="mt-4">Không tìm thấy sản phẩm nào.</p>
    @endif
</div>
@endsection