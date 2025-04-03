<?php $__env->startSection('item-product', 'open'); ?>
<?php $__env->startSection('item-product-index', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Sản phẩm /</span><span> Cập nhật - <?php echo e($product->name); ?></span>
            </h4>
            <div class="app-ecommerce">
                <form action="<?php echo e(route('products.update', $product->id)); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Cập nhật sản phẩm</h4>
                            <p class="text-muted">Orders placed across your store</p>
                        </div>

                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                            </a>
                            <button type="reset" class="btn btn-secondary"> Nhập lại</button>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success fw-bold">
                            <?php echo e(session()->get('success')); ?>

                        </div>
                    <?php endif; ?>
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
                                        <label class="form-label" for="ecommerce-product-name">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="ecommerce-product-name"
                                            placeholder="Product Name" name="name" aria-label="name"
                                            value="<?php echo e($product->name); ?>">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><label class="form-label" for="ecommerce-product-sku">Mã
                                                sp</label>
                                            <input type="text" class="form-control" id="ecommerce-product-sku"
                                                placeholder="sku" name="sku" aria-label="Product sku"
                                                value="<?php echo e($product->sku); ?>">
                                        </div>
                                        <div class="col"><label class="form-label" for="ecommerce-product-sku">Số
                                                lượng</label>
                                            <input type="number" class="form-control" id="ecommerce-product-quantity"
                                                placeholder="quantity" name="quantity" value="<?php echo e($product->quantity); ?>">
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-name">Mô tả</label>
                                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="description" name="description"
                                            aria-label="description"><?php echo e($product->description); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Nội dung</label>
                                        <textarea type="text" class="form-control" id="content" placeholder="content" name="content" aria-label="content"><?php echo e($product->content); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Hình ảnh</label>
                                        <input type="file" class="form-control" name="img_thumbnail">
                                        <img src="<?php echo e(Storage::url($product->img_thumbnail)); ?>" width="50px"
                                            class="rounded mt-2">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="content">Hướng dẫn bảo quản</label>
                                        <textarea type="text" class="form-control" name="user_manual"><?php echo e($product->user_manual); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Album ảnh</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3" id="gallery-container">
                                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex align-content-center gap-2"
                                                id="gallery_<?php echo e($loop->iteration); ?>">
                                                <input type="file" class="form-control"
                                                    name="product_galleries[<?php echo e($item->id); ?>]"
                                                    id="gallery_input_<?php echo e($item->id); ?>">

                                                <button type="button" class="btn btn-danger remove-gallery"
                                                    data-id="gallery_<?php echo e($loop->iteration); ?>">Xóa</button>
                                            </div>
                                            <div>
                                                <img src="<?php echo e(Storage::url($item->img)); ?>" alt="" width="50px"
                                                    class="rounded mb-2">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($errors->has('product_galleries')): ?>
                                            <div class="text-danger">
                                                <?php echo e($errors->first('product_galleries')); ?>

                                            </div>
                                        <?php endif; ?>
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
                                    <input type="checkbox" id="hasVariants"
                                        <?php if($product->variants && $product->variants->count() > 0): ?> checked <?php endif; ?> class="form-check-input">
                                    <label class="form-check-label mb-2" for="hasVariants">Sản phẩm này có biến
                                        thể</label>

                                    <!-- Biến thể sản phẩm (ẩn theo mặc định) -->

                                    <?php if($product->variants->isEmpty()): ?>
                                        <div id="variantsSection" style="display: none;">
                                            <div id="variants" class="mb-3">
                                                <div class="variant border p-3">
                                                    <h5 class="mt-3">Thuộc Tính 1</h5>
                                                    <div class="mb-3">
                                                        <label for="variant_sku_0">Mã biến thể</label>

                                                        <input type="text" id="variant_sku_0" name="variants[0][sku]"
                                                            placeholder="Mã biến thể" class="form-control"
                                                            value="<?php echo e(old('variant_sku_0')); ?>">
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="variant_quantity_0">Số lượng tồn kho</label>

                                                        <input type="number" id="variant_quantity_0"
                                                            name="variants[0][quantity]" class="form-control"
                                                            placeholder="Số lượng tồn kho"
                                                            value="<?php echo e(old('variants[0][quantity]')); ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" id="variant_image_0"
                                                            name="variants[0][image]" class="form-control">
                                                    </div>
                                                    <!-- Thuộc tính của biến thể -->
                                                    <div id="attributesSection_0 mb-3">
                                                        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mt-3">
                                                                <label
                                                                    for="variant_attribute_<?php echo e($attribute->id); ?>_0"><?php echo e($attribute->name); ?></label>
                                                                <select class="select2 form-select"
                                                                    id="variant_attribute_<?php echo e($attribute->id); ?>_0"
                                                                    name="variants[0][attributes][<?php echo e($attribute->id); ?>]"
                                                                    class="form-control">
                                                                    <option value="">Chọn <?php echo e($attribute->name); ?>

                                                                    </option>
                                                                    <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($value->id); ?>">
                                                                            <?php echo e($value->value); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="add-variant" class="btn btn-primary "><i
                                                    class="mdi mdi-plus me-0 me-sm-1"></i>Thêm Thuộc
                                                Tính</button>
                                        </div>
                                    <?php elseif($product): ?>
                                        <div id="variantsSection" <?php if($product->variants && $product->variants->count() === 0): ?> class="d-none" <?php endif; ?>>
                                            <div id="variants" class="mb-3">
                                                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variantIndex => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="variant border p-3 mb-3"
                                                        id="variant[<?php echo e($variantIndex); ?>]">
                                                        <h5 class="mt-3">Thuộc tính <?php echo e($loop->iteration); ?></h5>
                                                        <div class="mb-3">
                                                            <label for="variant_sku_<?php echo e($variantIndex); ?>">Mã biến
                                                                thể</label>
                                                            <input type="text" id="variant_sku_<?php echo e($variantIndex); ?>"
                                                                name="variants[<?php echo e($variant->id); ?>][sku]"
                                                                placeholder="Mã biến thể" class="form-control"
                                                                value="<?php echo e($variant->sku); ?>">
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="variant_quantity_<?php echo e($variantIndex); ?>">Số lượng tồn
                                                                kho</label>
                                                            <input type="number"
                                                                id="variant_quantity_<?php echo e($variantIndex); ?>"
                                                                name="variants[<?php echo e($variant->id); ?>][quantity]"
                                                                class="form-control" placeholder="Số lượng tồn kho"
                                                                value="<?php echo e($variant->quantity); ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="file" id="variant_image_<?php echo e($variantIndex); ?>"
                                                                name="variants[<?php echo e($variant->id); ?>][image]"
                                                                class="form-control">
                                                            <img src="<?php echo e(Storage::url($variant->image)); ?>" alt=""
                                                                srcset="" width="50px" class="rounded mt-2">
                                                        </div>
                                                        <!-- Thuộc tính của biến thể -->
                                                        <div id="attributesSection_<?php echo e($variantIndex); ?> mb-3">
                                                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="mt-3">
                                                                    <label
                                                                        for="variant_attribute_<?php echo e($attribute->id); ?>_<?php echo e($variantIndex); ?>"><?php echo e($attribute->name); ?></label>
                                                                    <select class="select2 form-select"
                                                                        id="variant_attribute_<?php echo e($attribute->id); ?>_<?php echo e($variantIndex); ?>"
                                                                        name="variants[<?php echo e($variant->id); ?>][attributes][<?php echo e($attribute->id); ?>]"
                                                                        class="form-control">
                                                                        <option value="">Chọn <?php echo e($attribute->name); ?>

                                                                        </option>
                                                                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option <?php if($variant->attributes->contains('attribute_value_id', $value->id)): echo 'selected'; endif; ?>
                                                                                value="<?php echo e($value->id); ?>">
                                                                                <?php echo e($value->value); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <button type="button" id="add-variant" class="btn btn-primary "><i
                                                    class="mdi mdi-plus me-0 me-sm-1"></i>Thêm Thuộc
                                                Tính</button>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!-- /Product Information -->
                        </div>
                        <!-- Second column -->
                        <div class="col-12 col-lg-4">
                            
                            <div class="card mb-4 p-3">
                                <div class="mb-3 form-check form-switch">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                        id="is_active" <?php echo e($product->is_active ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_active">Hoạt động</label>
                                </div>

                                <div class="mb-3 form-check form-switch">
                                    <input type="checkbox" name="is_good_deal" class="form-check-input" value="1"
                                        id="is_good_deal" <?php echo e($product->is_good_deal ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_good_deal">Ưu đãi tốt</label>
                                </div>

                                

                                <div class="mb-3 form-check form-switch">
                                    <input type="checkbox" name="is_show_home" class="form-check-input" value="1"
                                        id="is_show_home" <?php echo e($product->is_show_home ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_show_home">Sản phẩm nổi bật</label>
                                </div>
                            </div>

                            <!-- /danh mục -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Danh mục & Thương hiệu</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select name="category_id" class="form-select">
                                            <option value="" disabled selected>Chọn danh mục</option>
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($product->category_id == $categori->id): echo 'selected'; endif; ?> value="<?php echo e($categori->id); ?>">
                                                    <?php echo e($categori->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <!-- thương hiệu -->
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Thương hiệu</label>
                                        <select name="brand_id" class="form-select">
                                            <option value="" disabled selected>Chọn thương hiệu</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($product->brand_id == $brand->id): echo 'selected'; endif; ?> value="<?php echo e($brand->id); ?>">
                                                    <?php echo e($brand->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                        <input type="number" class="form-control" id="base_price"
                                            placeholder="base_price" name="base_price" aria-label="base_price"
                                            value="<?php echo e($product->base_price); ?>">
                                    </div>
                                    <!-- Discounted Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="ecommerce-product-discount-price">Giá ưu
                                            đãi</label>
                                        <input type="number" class="form-control" id="price_sale"
                                            placeholder="price_sale" name="price_sale" aria-label="price_sale"
                                            value="<?php echo e($product->price_sale); ?>">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <script>
        let galleryIndex = <?php echo e(count($product->images)); ?>;
        document.addEventListener('DOMContentLoaded', function() {
            const galleryContainer = document.getElementById('gallery-container');
            const addGalleryButton = document.getElementById('add-gallery');

            addGalleryButton.addEventListener('click', function() {
                galleryIndex++;
                const newGalleryDiv = document.createElement('div');
                newGalleryDiv.classList.add('d-flex', 'align-items-center', 'gap-2', 'mb-2');
                newGalleryDiv.id = `gallery_${galleryIndex}`;
                newGalleryDiv.innerHTML = `
            <input type="file" class="form-control" name="product_galleries[new_${galleryIndex}]" id="gallery_input_${galleryIndex}">
            <button type="button" class="btn btn-danger remove-gallery" data-id="gallery_${galleryIndex}">Xóa</button>
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
        const attributesData = <?php echo json_encode($attributes, 15, 512) ?>;
        let variantIndex = <?php echo e($product->variants ? $product->variants->count() : 0); ?>;

        document.getElementById('hasVariants').addEventListener('change', function() {
            const variantsSection = document.getElementById('variantsSection');
            variantsSection.style.display = this.checked ? 'block' : 'none';
        });

        document.getElementById('add-variant').addEventListener('click', function() {
            let variantsDiv = document.getElementById('variants');
            let newVariantDiv = document.createElement('div');
            newVariantDiv.classList.add('variant', 'border', 'p-3', 'mt-3');
            newVariantDiv.id = `variant[${variantIndex}]`;
            newVariantDiv.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mt-3">Thuộc Tính ${variantIndex + 1}</h5>
            <button type="button" class="btn btn-danger remove-variant" data-id="variant_${variantIndex}">Xóa</button>
        </div>

        <div class="mb-3">
            <label for="variant_sku_${variantIndex}">Mã biến thể</label>
            <input type="text" id="variant_sku_${variantIndex}" name="variants[new_${variantIndex}][sku]" placeholder="Mã biến thể" class="form-control">
        </div>

        <div class="mb-4">
            <label for="variant_quantity_${variantIndex}">Số lượng tồn kho</label>
            <input type="number" id="variant_quantity_${variantIndex}" name="variants[new_${variantIndex}][quantity]" class="form-control" placeholder="Số lượng tồn kho">
        </div>

        <div class="mb-3">
            <input type="file" id="variant_image_${variantIndex}" name="variants[new_${variantIndex}][image]" class="form-control">
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
            <select id="variant_attribute_${attribute.id}_${index}" name="variants[new_${index}][attributes][${attribute.id}]" class="form-control">
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
    <script>
        $(document).ready(function() {
            $(".form-check-input").bootstrapSwitch();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>