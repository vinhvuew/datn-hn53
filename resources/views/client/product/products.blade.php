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

    <div class="container mt-5 pt-5">
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
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Hãng -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Hãng</strong></label>
                                <select class="form-select" name="brand">
                                    <option value="">Chọn hãng</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Giá sale -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Khoảng giá</strong></label>
                                <input type="range" class="form-range" name="price_sale" id="priceRange" min="0" max="10000" step="100" value="{{ request('price_sale', 0) }}">
                                <div class="d-flex justify-content-between">
                                    <span>0đ</span>
                                    <span id="priceValue">{{ request('price_sale', 0) }}đ</span> <!-- Hiển thị giá trị hiện tại -->
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
                <!-- Đoạn code hiển thị danh sách sản phẩm -->
                <div class="row small-gutters">
                    @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <figure>
                                @if ($product->price_sale)
                                <span class="ribbon off">-{{ round((($product->price_sale - $product->base_price) / $product->price_sale) * 100) }}%</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <img class="img-fluid lazy" src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="{{ $product->name }}" width="400" height="400">
                                </a>
                            </figure>
                            <div class="rating">
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star"></i>
                            </div>
                            <a href="{{ route('product.show', $product->slug) }}">
                                <h3>{{ $product->name }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $product->base_price }}đ</span>
                                @if ($product->price_sale)
                                <span class="old_price">{{ $product->price_sale }}đ</span>
                                @endif
                            </div>
                            <ul>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Phân trang -->
                <div class="pagination__wrapper d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>

            <!-- Phân trang -->
            <div class="pagination__wrapper d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
</main>
@endsection