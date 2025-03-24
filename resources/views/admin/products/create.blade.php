@extends('admin.layouts.master')
@section('item-product', 'open')
@section('item-product-create', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span><span> Thêm mới sản phẩm</span>
            </h4>
            <div class="app-ecommerce">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Thêm mới 1 sản phẩm</h4>
                            <p class="text-muted">Orders placed across your store</p>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                            <button type="reset" class="btn btn-secondary"> Nhập lại</button>
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </div>
                    </div>
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
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" id="ecommerce-product-name"
                                            placeholder="Product Name" name="name" aria-label="name"
                                            value="{{ old('name') }}">

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><label class="form-label" for="ecommerce-product-sku">Mã
                                                sp</label>
                                            @error('sku')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            <input type="text" class="form-control" id="ecommerce-product-sku"
                                                placeholder="sku" name="sku" aria-label="Product sku"
                                                value="{{ old('sku') }}">
                                        </div>

                                        <div class="col"><label class="form-label" for="ecommerce-product-sku">Số
                                                lượng</label>
                                            @error('quantity')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            <input type="number" class="form-control" id="ecommerce-product-quantity"
                                                placeholder="quantity" name="quantity">
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">

                                        <label class="form-label" for="ecommerce-product-name">Mô tả</label>
                                        @error('description')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="description" name="description"
                                            aria-label="description" value="{{ old('description') }}"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        @error('content')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <label class="form-label" for="content">Nội dung</label>
                                        <textarea type="text" class="form-control" id="content" placeholder="content" name="content" aria-label="content"
                                            value="{{ old('content') }}"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Hình ảnh</label>
                                        @error('img_thumbnail')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <input type="file" class="form-control" name="img_thumbnail">
                                    </div>
                                    <div class="mb-3">
                                        @error('user_manual')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <label class="form-label" for="content">Hướng dẫn sử dụng</label>
                                        <textarea type="text" class="form-control" name="user_manual" value="{{ old('user_manual') }}"></textarea>
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
                                            @foreach ($errors->get('product_galleries.*') as $error)
                                                <div class="text-red-500">{{ $error[0] }}</div>
                                            @endforeach
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                id="gallery_input_1" multiple>
                                            @if ($errors->has('product_galleries'))
                                                <div class="text-danger">
                                                    {{ $errors->first('product_galleries') }}
                                                </div>
                                            @endif
                                        </div>
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
                                    <input type="checkbox" id="hasVariants" class="form-check-input">
                                    <label class="form-check-label mb-2" for="hasVariants">Sản phẩm này có biến
                                        thể</label>

                                    <!-- Biến thể sản phẩm (ẩn theo mặc định) -->
                                    <div id="variantsSection" style="display: none;">
                                        <div id="variants" class="mb-3">
                                            <div class="variant border p-3">
                                                <h5 class="mt-3">Thuộc Tính 1</h5>
                                                <div class="mb-3">
                                                    <label for="variant_sku_0">Mã biến thể</label>
                                                    {{-- @error('sku')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror --}}
                                                    <input type="text" id="variant_sku_0" name="variants[0][sku]"
                                                        placeholder="Mã biến thể" class="form-control"
                                                        value="{{ old('variant_sku_0') }}">
                                                </div>

                                                <div class="mb-4">
                                                    <label for="variant_quantity_0">Số lượng tồn kho</label>
                                                    {{-- @error('quantity')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror --}}
                                                    <input type="number" id="variant_quantity_0"
                                                        name="variants[0][quantity]" class="form-control"
                                                        placeholder="Số lượng tồn kho"
                                                        value="{{ old('variants[0][quantity]') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="file" id="variant_image_0" name="variants[0][image]"
                                                        class="form-control">
                                                </div>
                                                <!-- Thuộc tính của biến thể -->
                                                <div id="attributesSection_0 mb-3">
                                                    @foreach ($attributes as $attribute)
                                                        <div class="mt-3">
                                                            <label
                                                                for="variant_attribute_{{ $attribute->id }}_0">{{ $attribute->name }}</label>
                                                            <select class="select2 form-select"
                                                                id="variant_attribute_{{ $attribute->id }}_0"
                                                                name="variants[0][attributes][{{ $attribute->id }}]"
                                                                class="form-control">
                                                                <option value="">Chọn {{ $attribute->name }}
                                                                </option>
                                                                @foreach ($attribute->values as $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
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
                                    <h5 class="card-title mb-0">Danh mục & thương hiệu</h5>
                                </div>
                                <div class="card-body">
                                    {{-- danh mục --}}
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Danh mục</label>

                                        <select name="category_id" class="form-select">
                                            <option value="" disabled selected>Chọn danh mục</option>
                                            @foreach ($category as $categori)
                                                <option value="{{ $categori->id }}">{{ $categori->name }}</option>
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
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                    <h5 class="card-title mb-0">Giá tiền</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Base Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="base_price">giá cơ bản</label>
                                        <input type="number" class="form-control" id="base_price"
                                            placeholder="base_price" name="base_price" aria-label="base_price">
                                        @error('base_price')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Discounted Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-discount-price">giá bán</label>
                                        <input type="number" class="form-control" id="price_sale"
                                            placeholder="price_sale" name="price_sale" aria-label="price_sale">
                                        @error('price_sale')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let galleryCount = 1;
            const galleryContainer = document.getElementById('gallery-container');
            const addGalleryButton = document.getElementById('add-gallery');

            addGalleryButton.addEventListener('click', function() {
                galleryCount++;
                const newGalleryDiv = document.createElement('div');
                newGalleryDiv.classList.add('d-flex', 'align-items-center', 'gap-2', 'mb-2');
                newGalleryDiv.id = `gallery_${galleryCount}`;
                newGalleryDiv.innerHTML = `
                <input type="file" class="form-control" name="product_galleries[]" id="gallery_input_${galleryCount}">
                <button type="button" class="btn btn-danger remove-gallery" data-id="gallery_${galleryCount}">Xóa</button>
            `;
                galleryContainer.appendChild(newGalleryDiv);
            });

            galleryContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-gallery')) {
                    const galleryId = event.target.getAttribute('data-id');
                    const galleryElement = document.getElementById(galleryId);
                    if (galleryElement) {
                        galleryElement.remove();
                    }
                }
            });
        });
    </script>
    <script>
        // JSON cho dữ liệu thuộc tính và các giá trị của chúng
        const attributesData = @json($attributes);

        document.getElementById('hasVariants').addEventListener('change', function() {
            const variantsSection = document.getElementById('variantsSection');
            variantsSection.style.display = this.checked ? 'block' : 'none';
        });

        let variantIndex = 1;
        document.getElementById('add-variant').addEventListener('click', function() {
            let variantsDiv = document.getElementById('variants');
            let newVariantDiv = document.createElement('div');
            newVariantDiv.classList.add('variant', 'border', 'p-3', 'mt-3');
            newVariantDiv.id = `variant_${variantIndex}`;
            newVariantDiv.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mt-3">Thuộc Tính ${variantIndex + 1}</h5>
                <button type="button" class="btn btn-danger remove-variant" data-id="variant_${variantIndex}">Xóa</button>
            </div>

            <div class="mb-3">
                <label for="variant_sku_${variantIndex}">Mã biến thể</label>
                <input type="text" id="variant_sku_${variantIndex}" name="variants[${variantIndex}][sku]" placeholder="Mã biến thể" class="form-control">
            </div>

            <div class="mb-4">
                <label for="variant_quantity_${variantIndex}">Số lượng tồn kho</label>
                <input type="number" id="variant_quantity_${variantIndex}" name="variants[${variantIndex}][quantity]" class="form-control" placeholder="Số lượng tồn kho">
            </div>

            <div class="mb-3">
                <input type="file" id="variant_image_${variantIndex}" name="variants[${variantIndex}][image]" class="form-control">
            </div>

            ${generateAttributeFields(variantIndex)}
        `;

            variantsDiv.appendChild(newVariantDiv);
            variantIndex++;
        });

        function generateAttributeFields(index) {
            let fieldsHTML = '';
            attributesData.forEach(attribute => {
                let optionsHTML = `<option value="">Chọn ${attribute.name}</option>`;

                attribute.values.forEach(value => {
                    optionsHTML += `<option value="${value.id}">${value.value}</option>`;
                });

                fieldsHTML += `
            <div class="mb-3">
                <label for="variant_attribute_${attribute.id}_${index}">${attribute.name}</label>
                <select id="variant_attribute_${attribute.id}_${index}" name="variants[${index}][attributes][${attribute.id}]" class="form-control">
                    ${optionsHTML}
                </select>
            </div>
        `;
            });
            return fieldsHTML;
        }

        // Lắng nghe sự kiện click để xóa biến thể
        document.getElementById('variants').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-variant')) {
                const variantId = event.target.getAttribute('data-id');
                const variantElement = document.getElementById(variantId);
                if (variantElement) {
                    variantElement.remove();
                }
            }
        });
    </script>
@endsection
