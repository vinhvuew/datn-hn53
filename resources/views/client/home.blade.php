@extends('client.layouts.master')
@section('content')

    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                <div class="owl-slide cover"
                    style="background-image: url({{ asset('client.home') }}/img/slides/slide_home_2.jpg);">
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
        <!--/carousel-->

        <ul id="banners_grid" class="clearfix">
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('client') }}/img/banners_cat_placeholder.jpg"
                        data-src="{{ asset('client') }}/img/banner_1.jpg" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Men's Collection</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('client') }}/img/banners_cat_placeholder.jpg"
                        data-src="{{ asset('client') }}/img/banner_2.jpg" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Womens's Collection</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#0" class="img_container">
                    <img src="{{ asset('client') }}/img/banners_cat_placeholder.jpg"
                        data-src="{{ asset('client') }}/img/banner_3.jpg" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Kids's Collection</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
        </ul>
        <!--/banners_grid -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm mới ra</h2>
                <span>Latest Products</span>

            </div>
            <div class="row small-gutters">
                @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>

                            <img src="{{ Storage::url($product->img_thumbnail) }}"
                                width="300px" alt="50">

                        </figure>
                        <h3>{{ $product->name }}</h3>
                        <div class="price_box">
                            <span class="old_price">{{ $product->base_price }}đ</span>

                            @if ($product->price_sale)
                            <span class="new_price">{{ $product->price_sale }}đ</span>


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
        </div>

        <!-- /container -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>SALE SẢN PHẨM</h2>
                <span>SẢN PHẨM GIẢM GIÁ</span>

            </div>

            <div class="carousel-inner">
                @foreach($discountedProducts as $key => $product)
                    <div class="carousel-item @if($key == 0) active @endif">
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
                @foreach($topSellingProducts as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>

                            <img src="{{ Storage::url($product->img_thumbnail) }}"
                                width="300px" alt="50">

                        </figure>
                        <h3>{{ $product->name }}</h3>
                        <div class="price_box">
                            <span class="old_price">{{ $product->base_price }}đ</span>

                            @if ($product->price_sale)
                            <span class="new_price">{{ $product->price_sale }}đ</span>


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
                        @foreach($brands as $brand)
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
            <!-- /row -->
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

                .carousel-control-prev, .carousel-control-next {
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

</div>
        <!-- /container -->
    </main>
    <!-- /main -->

@endsection
