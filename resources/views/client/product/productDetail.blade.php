@extends('client.layouts.master')

@section('content')
    <main>
        <div class="container margin_30">
            <div class="countdown_inner">-20% This offer ends in <div data-countdown="2025/05/15" class="countdown"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                @foreach ($product->images as $image)
                                    <div style="background-image: url({{ Storage::url($image->img) }})" class="item-box">
                                    </div>
                                @endforeach
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                @foreach ($product->images as $image)
                                    <div style="background-image: url({{ Storage::url($image->img) }})" class="item active">
                                    </div>
                                @endforeach


                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Sản phẩm</a></li>
                            <li>Chi tiết sản phẩm</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <form action="{{ route('addToCart') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="prod_info">
                            <h1>{{ $product->name }}</h1>
                            <span class="rating">
                                <i class="icon-star voted"></i><i class="icon-star voted"></i>
                                <i class="icon-star voted"></i><i class="icon-star voted"></i>
                                <i class="icon-star"></i><em>4 reviews</em>
                            </span>
                            <p><small>SKU: {{ $product->sku }}</small><br>{{ $product->description }}</p>

                            @if ($product->variants->isNotEmpty())
                                {{-- Nếu có biến thể --}}
                                <div class="prod_options">
                                    <div class="row">
                                        @php
                                            $groupAttribute = [];
                                            $arr = [];
                                        @endphp
                                        @foreach ($product->variants as $variant)
                                            @foreach ($variant->attributes as $attribute)
                                                @php
                                                    $data = [
                                                        'id' => $attribute->attributeValue->id,
                                                        'name' => $attribute->attributeValue->value,
                                                    ];

                                                    if (!in_array($data, $arr)) {
                                                        $arr[] = $data;
                                                    }

                                                    $attributeName = $attribute->attribute->name;
                                                    if (!isset($groupAttribute[$attributeName])) {
                                                        $groupAttribute[$attributeName] = [];
                                                    }

                                                    if (!in_array($data, $groupAttribute[$attributeName])) {
                                                        $groupAttribute[$attributeName][] = $data;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach

                                        @foreach ($groupAttribute as $attributeName => $values)
                                            <label class="col-xl-5 col-lg-5 col-md-6 col-6 pt-0">
                                                <strong>{{ $attributeName }}</strong>
                                            </label>
                                            <div class="col-xl-4 col-lg-5 col-md-6 col-6 mb-2">
                                                <select name="variant_attributes[attribute_value_id][]"
                                                    class="form-select attribute-select mb-1"
                                                    data-attribute-name="{{ $attributeName }}">
                                                    @foreach ($values as $value)
                                                        @php
                                                            $variant = $product->variants->firstWhere(function (
                                                                $variant,
                                                            ) use ($value) {
                                                                return $variant->attributes->firstWhere(
                                                                    'attributeValue.id',
                                                                    $value['id'],
                                                                );
                                                            });

                                                            $stock = $variant ? $variant->quantity : 0;
                                                        @endphp

                                                        <option value="{{ $value['id'] }}"
                                                            data-stock="{{ $stock }}">
                                                            {{ Str::limit($value['name'], 30) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Số lượng</strong></label>
                                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                            <div class="numbers-row">
                                                <input type="text" value="1" id="quantity" class="qty2"
                                                    name="quantity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="quantity mt-2">
                                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Tồn kho</strong></label>
                                        <span id="variant-stock" style="margin-left: 87px">
                                            {{ $product->variants->first()->quantity }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                {{-- Nếu không có biến thể --}}
                                <div class="row">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Số lượng</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="quantity" class="qty2"
                                                name="quantity">
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity mt-2">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Tồn kho</strong></label>
                                    <span id="product-stock" style="margin-left: 87px">
                                        {{ $product->quantity }}
                                    </span>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main">
                                        <label for=""> <strong>Đơn giá:</strong> </label>
                                        <span class="new_price ">{{ number_format($product->price_sale, 0, ',', '.') }}
                                            VND</span>
                                        {{-- <span class="percentage">-20%</span>
                                        <span class="old_price">$160.00</span> --}}
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @if ($product->price_sale)
                                        <input type="hidden" name="total_amount"
                                            value="{{ isset($finalPrice) ? $finalPrice : $product->price_sale }}">
                                    @elseif ($product->base_price)
                                        <input type="hidden" name="total_amount"
                                            value="{{ isset($finalPrice) ? $finalPrice : $product->base_price }}">
                                    @endif
                                    <button class="btn_1">THÊM VÀO GIỎ HÀNG</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <!-- /prod_info -->
                    <div class="product_actions">
                        <ul>
                            <li>
                                <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Bình
                            luận</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Mô tả</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                    aria-controls="collapse-A">
                                    Bình luận
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <h3>Bình luận</h3>
                                <div id="comments-container">
                                    @foreach ($comments as $comment)
                                        <div class="comment mb-3 p-3 border rounded">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $comment->user->name }}</strong>
                                                <span class="text-muted">{{ $comment->created_at }}</span>
                                            </div>
                                            <p class="mt-1">{{ $comment->content }}</p>

                                            <!-- Nút mở form trả lời -->
                                            <button class="btn btn-sm btn-outline-primary reply-toggle">Trả lời</button>

                                            <!-- Danh sách phản hồi -->
                                            @if ($comment->replies->count() > 0)
                                                <div class="replies ms-4 mt-2 border-start ps-3">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="reply mb-2">
                                                            <strong>{{ $reply->user->name }}</strong>
                                                            <p class="mb-1">{{ $reply->content }}</p>
                                                            <small class="text-muted">{{ $reply->created_at }}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <!-- Form trả lời (ẩn mặc định) -->
                                            <div class="reply-form mt-2 ms-4" style="display: none;">
                                                <form action="{{ route('add.reply') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <textarea name="content" class="form-control" rows="2" required></textarea>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success mt-2">Gửi</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-secondary mt-2 cancel-reply">Hủy</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Form bình luận chính -->
                                <h4>Để lại bình luận</h4>
                                <form action="{{ route('add.comment') }}" id="commentForm" method="POST">
                                    @csrf
                                    <input type="hidden" id="product_id" name="product_id"
                                        value="{{ $product->id }}">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Bình luận</label>
                                        <textarea class="form-control" id="comment" name="content" rows="3"></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Mô tả
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="product-description">
                                            <h4>Thông tin sản phẩm: {{ $product->name }}</h4>
                                            <p>Mô tả: <strong>{{ $product->description }}</strong>
                                            <p>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="product-specs">
                                            <h4>Hướng dẫn sử dụng</h4>
                                            <p>{{ $product->user_manual }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /tab B -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm cùng danh mục</h2>
                <span>Products</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">

                @if ($relatedProducts->isNotEmpty())
                    @foreach ($relatedProducts as $related)
                        <div class="item">
                            <div class="grid_item">
                                <span class="ribbon new">New</span>
                                <figure>
                                    <a href="{{ route('productDetail', $related->slug) }}">
                                        <img class="owl-lazy" src="{{ Storage::url($related->img_thumbnail) }}"
                                            data-src="{{ Storage::url($related->img_thumbnail) }}" alt="">
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                        class="icon-star voted"></i><i class="icon-star voted"></i><i
                                        class="icon-star"></i>
                                </div>
                                <a href="product-detail-1.html">
                                    <h3>{{ $related->name }}</h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">{{ number_format($related->price_sale, 0, ',', '.') }}
                                        VND</span>
                                </div>
                                <ul>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Add to favorites"><i
                                                class="ti-heart"></i><span>Add to favorites</span></a>
                                    </li>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Add to compare"><i
                                                class="ti-control-shuffle"></i><span>Add to
                                                compare</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Add to cart"><i
                                                class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>

                            <!-- /grid_item -->
                        </div>
                    @endforeach
                @else
                    <p>Không có sản phẩm cùng danh mục.</p>
                @endif
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="feat">
            <div class="container">
                <ul>
                    <li>
                        <div class="box">
                            <i class="ti-gift"></i>
                            <div class="justify-content-center">
                                <h3>Free Shipping</h3>
                                <p>For all oders over $99</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-wallet"></i>
                            <div class="justify-content-center">
                                <h3>Secure Payment</h3>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-headphone-alt"></i>
                            <div class="justify-content-center">
                                <h3>24/7 Support</h3>
                                <p>Online top support</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/feat-->

    </main>
@endsection

@section('style-libs')
    <link href="client/css/product_page.css" rel="stylesheet">
    <link href="{{ asset('client') }}/css/product_page.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('script-libs')
    <script src="{{ asset('client') }}/js/carousel_with_thumbs.js"></script>
    <script>
        document.getElementById("increaseQty").addEventListener("click", function() {
            let qtyInput = document.getElementById("quantityInput");
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        document.getElementById("decreaseQty").addEventListener("click", function() {
            let qtyInput = document.getElementById("quantityInput");
            if (qtyInput.value > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các dropdown attribute
            const attributeSelects = document.querySelectorAll('.attribute-select');

            // Lấy phần tử hiển thị số lượng
            const stockDisplay = document.getElementById('variant-stock');

            // Lắng nghe sự kiện thay đổi trên mỗi dropdown
            attributeSelects.forEach(select => {
                select.addEventListener('change', function() {
                    // Lấy stock từ option được chọn
                    const selectedOption = this.options[this.selectedIndex];
                    const stock = selectedOption.getAttribute('data-stock') || 0;

                    // Cập nhật số lượng hiển thị
                    stockDisplay.textContent = stock;
                });
            });
        });
    </script> --}}
    {{-- check số lượng --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const attributeSelects = document.querySelectorAll(".attribute-select");
            const stockDisplay = document.getElementById("variant-stock");

            function updateStock() {
                let selectedVariant = null;
                let selectedAttributes = [];

                // Lặp qua các dropdown để lấy giá trị thuộc tính được chọn
                attributeSelects.forEach(select => {
                    selectedAttributes.push(select.value);
                });

                // Kiểm tra biến thể phù hợp
                @json($product->variants).forEach(variant => {
                    let variantAttributes = variant.attributes.map(attr => attr.attribute_value_id
                        .toString());

                    if (JSON.stringify(variantAttributes.sort()) === JSON.stringify(selectedAttributes
                            .sort())) {
                        selectedVariant = variant;
                    }
                });

                // Cập nhật số lượng tồn kho
                if (selectedVariant) {
                    stockDisplay.textContent = selectedVariant.quantity;
                } else {
                    stockDisplay.textContent = "Không có hàng";
                }
            }

            // Gắn sự kiện thay đổi cho dropdown
            attributeSelects.forEach(select => {
                select.addEventListener("change", updateStock);
            });

            // Cập nhật số lượng khi tải trang
            updateStock();
        });
    </script>
    {{-- comment --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".reply-toggle").forEach(button => {
                button.addEventListener("click", function() {
                    let commentContainer = this.closest(".comment");
                    let replyForm = commentContainer.querySelector(".reply-form");
                    if (replyForm.style.display === "none" || replyForm.style.display === "") {
                        replyForm.style.display = "block";
                    } else {
                        replyForm.style.display = "none";
                    }
                });
            });

            document.querySelectorAll(".cancel-reply").forEach(button => {
                button.addEventListener("click", function() {
                    let replyForm = this.closest(".reply-form");
                    replyForm.style.display = "none";
                });
            });
        });
    </script>
@endsection
