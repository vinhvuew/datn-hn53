@extends('client.layouts.master')
@section('content')
    <main>
        <div id="carousel-home">
            <div class="carousel-container">
                <div class="carousel-slide"
                    style="background-image: url({{ asset('client') }}/img/slides/slide_home_2.jpg);">
                    <div class="overlay">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="slide-text">
                                        <h2>Attack Air<br>Max 720 Sage Low</h2>
                                        <p>Limited items available at this price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <form action="{{ route('product.search') }}" method="GET" class="search-form-small" style="margin-top: 20px; display: flex; justify-content: flex-start;">
                <input type="text" name="q" class="search-input-small" placeholder="Tìm sản phẩm..." required>
                <button type="submit" class="search-button-small">🔍</button>
            </form>
        </div>

        <div class="container">
            <div class="row">
                <!-- Sidebar bộ lọc -->
                <div class="col-md-3">
                    <div class="filter-section">
                        <h3>Bộ lọc sản phẩm</h3>
                        <form action="{{ route('product.filter') }}" method="GET" class="filter-form">
                            <label for="price">Giá:</label>
                            <select name="price" id="price">
                                <option value="">Tất cả</option>
                                <option value="0-500000">Dưới 500.000 VNĐ</option>
                                <option value="500000-1000000">500.000 - 1.000.000 VNĐ</option>
                                <option value="1000000-">Trên 1.000.000 VNĐ</option>
                            </select>
                            
                            <label for="size">Size:</label>
                            <select name="size" id="size">
                                <option value="">Tất cả</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            
                            <label for="color">Màu:</label>
                            <select name="color" id="color">
                                <option value="">Tất cả</option>
                                <option value="red">Đỏ</option>
                                <option value="blue">Xanh</option>
                                <option value="black">Đen</option>
                                <option value="white">Trắng</option>
                            </select>
                            
                            <button type="submit" class="btn btn-filter">Lọc sản phẩm</button>
                        </form>
                    </div>
                </div>
                
                <!-- Danh sách sản phẩm -->
                <div class="col-md-9">
                    <div class="main-title">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                    <div class="product-grid row">
                        @foreach($newProducts as $product)
                            <div class="product-item col-md-4 col-sm-6">
                                <figure>
                                    <a href="#">
                                        <img class="product-image img-fluid"
                                            src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="{{ $product->name }}">
                                    </a>
                                </figure>
                                <a href="#">
                                    <h3>{{ $product->name }}</h3>
                                </a>
                                <div class="price-box">
                                    @if($product->price_sale)
                                        <span class="new-price">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</span>
                                        <span class="old-price">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="btn btn-primary">🛒 Thêm vào giỏ</a>
                                    <a href="#" class="btn btn-secondary">🔍 Xem chi tiết</a>
                                    <a href="#" class="btn btn-success">💰 Mua ngay</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="main-title">
                        <h2>Sản phẩm bán chạy</h2>
                    </div>
                    <div class="product-grid row">
                        @foreach($bestSellingProducts as $product)
                            <div class="product-item col-md-4 col-sm-6">
                                <figure>
                                    <a href="#">
                                        <img class="product-image img-fluid"
                                            src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="{{ $product->name }}">
                                    </a>
                                </figure>
                                <a href="#">
                                    <h3>{{ $product->name }}</h3>
                                </a>
                                <div class="price-box">
                                    @if($product->price_sale)
                                        <span class="new-price">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</span>
                                        <span class="old-price">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="btn btn-primary">🛒 Thêm vào giỏ</a>
                                    <a href="#" class="btn btn-secondary">🔍 Xem chi tiết</a>
                                    <a href="#" class="btn btn-success">💰 Mua ngay</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
