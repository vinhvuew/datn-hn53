@extends('client.layouts.master')
@section('content')
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                <div class="owl-slide cover"
                    style="background-image: url({{ asset('client') }}/img/slides/slide_home_2.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-end white">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage
                                            Low</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Limited items available at this price
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover"
                    style="background-image: url({{ asset('client') }}/img/slides/slide_home_1.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>VaporMax
                                            Flyknit 3</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Limited items available at this price
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover"
                    style="background-image: url({{ asset('client') }}/img/slides/slide_home_3.jpg);">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center black">
                                        <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Monarch IV SE
                                        </h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Lightweight cushioning and durable support with a Phylon midsole
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/owl-slide-->
                </div>
            </div>
            <div id="icon_drag_mobile"></div>
        </div>

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm mới ra</h2>
                <span>Sản phẩm Mới</span>

            </div>
            <div class="row small-gutters">
                <div class="row g-4">
                    @foreach ($latestProducts as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card border-0 shadow-sm rounded overflow-hidden position-relative product-card">
                                <a href="{{ route('productDetail', $product->slug) }}" class="d-block">
                                    <img src="{{ Storage::url($product->img_thumbnail) }}"
                                        class="card-img-top img-fluid rounded product-image" alt="{{ $product->name }}">
                                </a>

                                <div class="card-body text-center">
                                    <a href="{{ route('productDetail', $product->slug) }}"
                                        class="text-dark text-decoration-none">
                                        <h4 class="fw-bold product-title">{{ $product->name }}</h4>
                                    </a>
                                    <p class="small text-muted">{{ Str::limit($product->description, 50) }}...</p>

                                    <div class="price_box">
                                        <span class="old_price text-muted text-decoration-line-through">
                                            {{ number_format($product->base_price, 0, ',', '.') }} VND
                                        </span>

                                        @if ($product->price_sale)
                                            <span class="new_price text-danger fw-bold">
                                                {{ number_format($product->price_sale, 0, ',', '.') }} VND
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- /container -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Hot Deals</h2>
                <span>Discounted Products</span>
                <p>Check out our latest deals and discounts!</p>
            </div>

            <div class="carousel-inner">
                @foreach ($discountedProducts as $key => $product)
                    <div class="carousel-item @if ($key == 0) active @endif">
                        <div class="row justify-content-center">
                            <div class="col-md-8"> <!-- Thay đổi từ col-md-4 thành col-md-8 để rộng hơn -->
                                <div class="grid_item" style="width: 100%; margin: 0 auto;">
                                    <figure>
                                        <a href="#">
                                            <img src="{{ Storage::url($product->img_thumbnail) }}"
                                                style="width: 100%; height: 300px; object-fit: cover; display: block; margin: 0 auto;"
                                                alt="Product Image">
                                        </a>
                                    </figure>
                                    <h3>{{ $product->name }}</h3>
                                    <div class="price_box">
                                        <span class="new_price">${{ $product->price_sale }}</span>
                                        <span class="old_price">${{ $product->base_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>


        <!-- /featured -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm bán chạy</h2>
                <span>Sản phẩm HOT</span>

            </div>
            <div class="row small-gutters">
                <div class="row g-4">
                    @foreach ($topSellingProducts as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="card border-0 shadow-sm rounded overflow-hidden position-relative product-card">
                                <a href="{{ route('productDetail', $product->slug) }}" class="d-block">
                                    <img src="{{ Storage::url($product->img_thumbnail) }}"
                                        class="card-img-top img-fluid rounded product-image" alt="{{ $product->name }}">
                                </a>

                                <div class="card-body text-center">
                                    <a href="{{ route('productDetail', $product->slug) }}"
                                        class="text-dark text-decoration-none">
                                        <h6 class="fw-bold product-title">{{ $product->name }}</h6>
                                    </a>
                                    <p class="small text-muted">{{ Str::limit($product->description, 50) }}</p>
                                    <div class="price_box">
                                        <span class="old_price text-muted text-decoration-line-through">
                                            {{ number_format($product->base_price, 0, ',', '.') }}đ
                                        </span>

                                        @if ($product->price_sale)
                                            <span class="new_price text-danger fw-bold">
                                                {{ number_format($product->price_sale, 0, ',', '.') }}đ
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>


        <!-- /container -->

        <div class="bg_gray">
            <div class="container margin_30">
                <div id="brands" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="#0"><img src="{{ asset('client') }}/img/brands/placeholder_brands.png"
                                data-src="{{ asset('client') }}/img/brands/logo_1.png" alt=""
                                class="owl-lazy"></a>
                    </div>

                </div>
                <!-- /carousel -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->

        <div class="container margin_60_35">

            <div class="row">
                <div class="col-lg-6">

                </div>
                <!-- /box_news -->
                <div class="container margin_60_35">
                    <div class="main_title">
                        <h2>Top Thương hiệu</h2>
                        <span>THương hiệu uy tín</span>

                    </div>
                    <div class="row">
                        @foreach ($brands as $brand)
                            <div class="col-md-3 col-6">
                                <div class="brand_item text-center">
                                    <h3>{{ $brand->name }}</h3>
                                    <p>{{ $brand->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->
@endsection
@section('style-libs')
    <!-- /row -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        .carousel {
            position: relative;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            transition: transform 1s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            display: none;
        }

        .carousel-item.active {
            display: block;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }
    </style>
    {{-- style sp --}}
    <style>
        /* Áp dụng font chữ đẹp */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hiệu ứng hover cho sản phẩm */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Hiệu ứng hover cho ảnh sản phẩm */
        .product-image {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* Hiệu ứng hover cho nút hành động */
        .action-btn {
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        /* Cải thiện typography */
        .product-title {
            font-size: 16px;
            font-weight: 700;
        }

        .price_box {
            font-size: 14px;
        }

        .old_price {
            color: #888;
            font-weight: 400;
        }

        .new_price {
            font-size: 18px;
            font-weight: 700;
            color: #e63946;
        }
    </style>
@endsection

@section('script-libs')
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll(".carousel-item");
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove("active");
                if (i === index) {
                    slide.classList.add("active");
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
        }

        // Tự động chạy slide mỗi 3 giây
        setInterval(nextSlide, 3000);

        // Hiển thị slide đầu tiên
        showSlide(currentIndex);
    </script>
@endsection
