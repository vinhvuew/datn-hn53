@extends('admin.layouts.master')
@section('item-product', 'open')
@section('item-product-index', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span><span> Cập nhật - {{ $product->name }}</span>
            </h4>
            <div class="app-ecommerce">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Cập nhật sản phẩm</h4>
                            <p class="text-muted">Orders placed across your store</p>
                        </div>

                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                            <button type="reset" class="btn btn-secondary"> Nhập lại</button>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success fw-bold">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <!-- First column-->
                        <div class="col-12 col-lg-8">
                            <!-- Product Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Product information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-name">Name</label>
                                        <input type="text" class="form-control" id="ecommerce-product-name"
                                            placeholder="Product Name" name="name" aria-label="name"
                                            value="{{ $product->name }}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><label class="form-label"
                                                for="ecommerce-product-sku">SKU</label>
                                            <input type="number" class="form-control" id="ecommerce-product-sku"
                                                placeholder="sku" name="sku" aria-label="Product sku"
                                                value="{{ $product->sku }}">
                                        </div>
                                        <div class="col"><label class="form-label"
                                                for="ecommerce-product-sku">Quantity</label>
                                            <input type="number" class="form-control" id="ecommerce-product-quantity"
                                                placeholder="quantity" name="quantity" value="{{ $product->quantity }}">
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-name">Description</label>
                                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="description" name="description"
                                            aria-label="description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Content</label>
                                        <textarea type="text" class="form-control" id="content" placeholder="content" name="content" aria-label="content">{{ $product->content }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Image</label>
                                        <input type="file" class="form-control" name="img_thumbnail">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" width="50px"
                                            class="rounded mt-2">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">User manual</label>
                                        <input type="text" class="form-control" name="user_manual"
                                            value="{{ $product->user_manual }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Album ảnh</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3" id="gallery-container">
                                        @foreach ($product->images as $item)
                                            <div id="gallery_{{ $loop->iteration }}">
                                                <input type="file" class="form-control"
                                                    name="product_galleries[{{ $item->id }}]"
                                                    id="gallery_input_{{ $item->id }}">
                                                <img src="{{ Storage::url($item->img) }}" alt="" width="50px"
                                                    class="rounded mt-2 mb-2">
                                            </div>
                                        @endforeach
                                        @if ($errors->has('product_galleries'))
                                            <div class="text-danger">
                                                {{ $errors->first('product_galleries') }}
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3" id="add-gallery"><i
                                            class="mdi mdi-plus me-0 me-sm-1"></i>Thêm</button>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Thuộc Tính</h5>
                                    <p>Thêm mới thuộc tính giúp sản phẩm có nhiều lựa chọn, như kích cỡ hay màu sắc.</p>
                                </div>
                                <div class="card-body" style="margin-top: -25px">
                                    @if (!$product->variants)
                                        <input type="checkbox" id="hasVariants" class="form-check-input">
                                        <label class="form-check-label mb-2" for="hasVariants">Sản phẩm này có biến
                                            thể</label>
                                    @endif
                                    <!-- Biến thể sản phẩm (ẩn theo mặc định) -->
                                    <div id="variantsSection">
                                        @foreach ($product->variants as $index => $variant)
                                            <div id="variants" class="mb-3">
                                                <div class="variant border p-3">
                                                    <h5 class="mt-3">Thuộc tính {{ $loop->iteration }}</h5>
                                                    <div class="mb-3">
                                                        <label for="variant_sku_{{ $index }}">Mã biến thể</label>
                                                        <input type="text" id="variant_sku_{{ $index }}"
                                                            name="variants[{{ $variant->id }}][sku]"
                                                            placeholder="Mã biến thể" class="form-control"
                                                            value="{{ $variant->sku }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="variant_selling_price_{{ $index }}">Giá điều
                                                            chỉnh</label>
                                                        <input type="number"
                                                            id="variant_selling_price_{{ $index }}"
                                                            name="variants[{{ $variant->id }}][selling_price]"
                                                            class="form-control" step="0.01"
                                                            placeholder="Giá điều chỉnh" max="99999999"
                                                            value="{{ $variant->selling_price }}">
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="variant_quantity_{{ $index }}">Số lượng tồn
                                                            kho</label>
                                                        <input type="number" id="variant_quantity_{{ $index }}"
                                                            name="variants[{{ $variant->id }}][quantity]"
                                                            class="form-control" placeholder="Số lượng tồn kho"
                                                            value="{{ $variant->quantity }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" id="variant_image_{{ $index }}"
                                                            name="variants[{{ $variant->id }}][image]"
                                                            class="form-control">
                                                        <img src="{{ Storage::url($variant->image) }}" alt=""
                                                            srcset="" width="50px" class="rounded mt-2">
                                                    </div>
                                                    <!-- Thuộc tính của biến thể -->
                                                    <div id="attributesSection_{{ $index }} mb-3">
                                                        @foreach ($attributes as $attribute)
                                                            <div class="mt-3">
                                                                <label
                                                                    for="variant_attribute_{{ $attribute->id }}_{{ $index }}">{{ $attribute->name }}</label>
                                                                <select class="select2 form-select"
                                                                    id="variant_attribute_{{ $attribute->id }}_{{ $index }}"
                                                                    name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]"
                                                                    class="form-control">
                                                                    <option value="">Chọn {{ $attribute->name }}
                                                                    </option>
                                                                    @foreach ($attribute->values as $value)
                                                                        <option @selected($variant->attributes->contains('attribute_value_id', $value->id))
                                                                            value="{{ $value->id }}">
                                                                            {{ $value->value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <button type="button" id="add-variant" class="btn btn-primary "><i
                                                class="mdi mdi-plus me-0 me-sm-1"></i>Thêm Thuộc
                                            Tính</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Information -->
                        </div>
                        <!-- Second column -->
                        <div class="col-12 col-lg-4">
                            <!-- /danh mục -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pricing</h5>
                                </div>
                                <div class="card-body">
                                    {{-- danh mục --}}
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select name="category_id" class="form-select">
                                            <option value="" disabled selected>Chọn danh mục</option>
                                            @foreach ($category as $categori)
                                                <option @selected($product->category_id == $categori->id) value="{{ $categori->id }}">
                                                    {{ $categori->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- thương hiệu -->
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Thương hiệu</label>
                                        <select name="brand_id" class="form-select">
                                            <option value="" disabled selected>Chọn thương hiệu</option>
                                            @foreach ($brands as $brand)
                                                <option @selected($product->brand_id == $brand->id) value="{{ $brand->id }}">
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Pricing Card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pricing</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Base Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="base_price">Base Price</label>
                                        <input type="number" class="form-control" id="base_price"
                                            placeholder="base_price" name="base_price" aria-label="base_price"
                                            value="{{ $product->base_price }}">
                                    </div>
                                    <!-- Discounted Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-discount-price">Price
                                            sale</label>
                                        <input type="number" class="form-control" id="price_sale"
                                            placeholder="price_sale" name="price_sale" aria-label="price_sale"
                                            value="{{ $product->price_sale }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /Pricing Card -->
                        </div>
                        <!-- /Second column -->
                    </div>
                </form>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection

@section('style-libs')
@endsection
@section('script-libs')
@endsection
