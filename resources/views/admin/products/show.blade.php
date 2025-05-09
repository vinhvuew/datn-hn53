@extends('admin.layouts.master')

@section('item-product', 'open')
@section('item-product-index', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span><span> Chi tiết - {{ $product->name }}</span>
            </h4>
            <div class="app-ecommerce">
                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-8">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-name">Tên sp</label>
                                    <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><label class="form-label" for="ecommerce-product-sku">Mã sp</label>
                                        <input type="text" class="form-control" value="{{ $product->sku }}" disabled>
                                    </div>
                                    <div class="col"><label class="form-label" for="ecommerce-product-sku">Số
                                            lượng</label>
                                        <input type="number" class="form-control" value="{{ $product->quantity }}"
                                            disabled>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-name">Mô tả</label>
                                    <textarea type="text" class="form-control" disabled>{{ $product->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Nội dung</label>
                                    <textarea type="text" class="form-control" disabled>{{ $product->content }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Hình ảnh</label>
                                    <img src="{{ asset('storage/' . $product->img_thumbnail) }} alt="Product Image">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Hướng dẫn sử dụng</label>
                                    <input type="text" class="form-control" value="{{ $product->user_manual }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Album ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3" id="gallery-container">
                                    <div id="gallery_1">
                                        @if ($product->images->isNotEmpty())
                                            @foreach ($product->images as $item)
                                                <img src="{{ Storage::url($item->img) }}" alt="Product Image" width="50px"
                                                    class="rounded">
                                            @endforeach
                                        @else
                                            <p>Không có hình ảnh nào cho sản phẩm này.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Thuộc Tính</h5>
                                @if ($product->variants->isEmpty())
                                    <em>Không có biến thể</em>
                                @else
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Sku</th>
                                                <th>Giá nhập</th>
                                                <th>Giá bán</th>
                                                <th>Tồn Kho</th>
                                                <th>Ảnh biến thể</th>
                                                <th>Thuộc Tính</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->variants as $variant)
                                                <tr>
                                                    <td>{{ $variant->sku }}</td>
                                                    <td>{{ number_format($variant->wholesale_price, 0, ',', '.') }} VND
                                                    </td>
                                                    <td>{{ number_format($variant->selling_price, 0, ',', '.') }} VND
                                                    </td>
                                                    <td>{{ $variant->quantity }}</td>
                                                    <td>
                                                        @if ($variant->image)
                                                            <img src="{{ Storage::url($variant->image) }}" width="50px"
                                                                class="rounded">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($variant->attributes)
                                                            <ul>
                                                                @foreach ($variant->attributes as $attribute)
                                                                    <li>{{ $attribute->attribute->name }}:
                                                                        {{ Str::limit($attribute->attributeValue->value, 15) }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <em>Không có thuộc tính</em>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <!-- /Product Information -->
                    </div>
                    <!-- Second column -->
                    <div class="col-12 col-lg-4">
                        <div class="card mb-4 p-3">
                            <div class="mb-3">
                                <label class="form-label"><strong>Hoạt động:</strong></label>
                                <span>{!! $product->is_active ? '✅' : '❌' !!}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Ưu đãi tốt:</strong></label>
                                <span>{!! $product->is_good_deal ? '✅' : '❌' !!}</span>
                            </div>

                            {{--
                            <div class="mb-3">
                                <label class="form-label"><strong>Sản phẩm mới:</strong></label>
                                <span>{!! $product->is_new ? '✅' : '❌' !!}</span>
                            </div>
                            --}}

                            <div class="mb-3">
                                <label class="form-label"><strong>Sản phẩm nổi bật:</strong></label>
                                <span>{!! $product->is_show_home ? '✅' : '❌' !!}</span>
                            </div>
                        </div>
                        <!-- /danh mục -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Danh mục & Thương hiệu</h5>
                            </div>
                            <div class="card-body">
                                {{-- danh mục --}}
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select name="category_id" class="form-select" disabled>
                                        <option>{{ $product->category->name }}</option>
                                    </select>
                                </div>
                                <!-- thương hiệu -->
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select name="brand_id" class="form-select" disabled>
                                        <option>{{ $product->brand->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Pricing Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Giá tiền</h5>
                            </div>
                            <div class="card-body">
                                <!-- Base Price -->
                                <div class="mb-3">
                                    <label class="form-label" for="base_price">Giá cơ bản</label>
                                    <input type="text" class="form-control"
                                        value="{{ number_format($product->base_price, 0, ',', '.') }} VND" disabled>

                                </div>
                                <!-- Discounted Price -->
                                <div class="mb-3">
                                    <label class="form-label" for="ecommerce-product-discount-price">Giá bán</label>
                                    <input type="text" class="form-control"
                                        value="{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /Pricing Card -->
                    </div>
                    <!-- /Second column -->
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection

@section('style-libs')
@endsection

@section('script-libs')
@endsection
