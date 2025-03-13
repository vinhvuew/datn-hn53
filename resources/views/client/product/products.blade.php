@extends('client.layouts.master')

@section('content')
    <main>
        <!-- Banner -->
        <div class="top_banner mb-5">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li>Page active</li>
                        </ul>
                    </div>
                    <h1>Shoes - Grid Listing</h1>
                </div>
            </div>
            <img src="client/img/bg_cat_shoes.jpg" class="img-fluid w-100" alt="">
        </div>
        <!-- /Banner -->

        <div class="container mt-2 pt-2">
            <div class="row">
                <!-- Bộ lọc (20%) -->
                <div class="col-lg-3" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h6 class="mb-0">Tìm Kiếm Sản Phẩm</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.filter') }}" method="GET">
                                <!-- Danh mục -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Danh mục</strong></label>
                                    <select class="form-select" name="category">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hãng -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Hãng</strong></label>
                                    <select class="form-select" name="brand">
                                        <option value="">Chọn hãng</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Giá sale -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Khoảng giá</strong></label>
                                    <input type="range" class="form-range" name="price_sale" id="priceRange"
                                        min="0" max="10000000" step="500" value="{{ request('price_sale', 0) }}">
                                    <div class="d-flex justify-content-between">
                                        <span>0đ</span>
                                        <span id="priceValue">{{ request('price_sale', 0) }}đ</span>
                                        <!-- Hiển thị giá trị hiện tại -->
                                    </div>
                                </div>

                                <!-- Nút lọc -->
                                <button type="submit" class="btn btn-primary w-100 mt-3">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm (70%) -->
                <div class="col-lg-9">
                    <!-- Danh sách sản phẩm -->
                    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3 mt-4">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card border-0 shadow-sm text-center h-100">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('product.show', $product->slug) }}" class="d-block">
                                            <img class="img-fluid lazy product-image"
                                                src="{{ asset('storage/' . $product->img_thumbnail) }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                                        </a>
                                        <div class="price_box">
                                            @if ($product->price_sale)
                                                <span
                                                    class="new_price text-danger fw-bold">{{ number_format($product->price_sale, 0, ',', '.') }}đ</span>
                                                <span
                                                    class="old_price text-muted text-decoration-line-through ms-2">{{ number_format($product->base_price, 0, ',', '.') }}đ</span>
                                            @else
                                                <span
                                                    class="new_price fw-bold">{{ number_format($product->base_price, 0, ',', '.') }}đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Phân trang -->
                    <div class="pagination__wrapper d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('style-libs')
    <!-- CSS cho dòng chữ chạy -->
    <style>
        .marquee {
            background-color: #ffc107;
            /* Màu nền vàng */
            padding: 10px 0;
            border-radius: 5px;
            overflow: hidden;
        }

        .marquee strong {
            font-size: 1.2rem;
            color: #dc3545;
            /* Màu chữ đỏ */
        }

        .product-image {
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .price_box {
            font-size: 1.1rem;
        }

        .new_price {
            font-weight: bold;
        }

        .old_price {
            font-size: 0.9rem;
            color: gray;
        }
    </style>
@endsection

@section('script-libs')
    <!-- JavaScript để cập nhật giá trị range slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            priceRange.addEventListener('input', function() {
                priceValue.textContent = this.value + 'đ';
            });

            priceValue.textContent = priceRange.value + 'đ';
        });
    </script>
@endsection
