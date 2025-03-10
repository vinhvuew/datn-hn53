@extends('client.layouts.master')
@section('content')
@foreach ($products as $product)
    <div class="col-sm-4">
        <figure>
            <a href="{{ route('product.filtered', $product->slug) }}">
                <img class="img-fluid" src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="{{ $product->name }}">
            </a>
            <figcaption>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <div class="price_box">
                    <span class="new_price">${{ $product->price }}</span>
                    @if ($product->price_sale)
                        <span class="old_price">${{ $product->price_sale }}</span>
                    @endif
                </div>
            </figcaption>
        </figure>
    </div>
@endforeach

<!-- Pagination (nếu có) -->
{{ $products->links() }}

@endsection