<?php $__env->startSection('content'); ?>
    <main>
        <div class="container margin_30">
            <div class="">
                <div class="countdown"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="background-image: url(<?php echo e(Storage::url($image->img)); ?>)" class="item-box">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="background-image: url(<?php echo e(Storage::url($image->img)); ?>)" class="item active">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
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
                    <form action="<?php echo e(route('addToCart')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="prod_info">
                            <h1><?php echo e($product->name); ?></h1>
                            <span class="rating">
                                <i class="icon-star voted"></i><i class="icon-star voted"></i>
                                <i class="icon-star voted"></i><i class="icon-star voted"></i>
                                <i class="icon-star"></i><em>4 reviews</em>
                            </span>
                            <p><small>Mã SP: <?php echo e($product->sku); ?></small><br><?php echo e($product->description); ?></p>
                            <?php if($product->variants->isNotEmpty()): ?>
                                <div class="prod_options">
                                    <div class="row">
                                        <?php
                                            $groupAttribute = [];
                                        ?>
                                        <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $variant->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $attributeName = $attribute->attribute->name;
                                                    $valueId = $attribute->attributeValue->id;
                                                    $valueName = $attribute->attributeValue->value;

                                                    if (!isset($groupAttribute[$attributeName])) {
                                                        $groupAttribute[$attributeName] = [];
                                                    }

                                                    $groupAttribute[$attributeName][$valueId] = $valueName;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php $__currentLoopData = $groupAttribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeName => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="col-12"><strong><?php echo e($attributeName); ?></strong></label>
                                            <div class="col-12 option-group">
                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <input type="radio" class="option-input"
                                                        name="variant_attributes[<?php echo e(Str::slug($attributeName)); ?>]"
                                                        id="attribute-<?php echo e($id); ?>" value="<?php echo e($id); ?>"
                                                        data-attribute="<?php echo e(Str::slug($attributeName)); ?>">
                                                    <label class="option-item" for="attribute-<?php echo e($id); ?>">
                                                        <?php echo e(Str::limit($name, 30)); ?>

                                                    </label>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="row">
                                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Số lượng</strong></label>
                                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                            <div class="numbers-row">
                                                <input type="text" value="1" id="quantity" class="qty2"
                                                    min="1" name="quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-12"><strong>Tồn kho</strong></label>
                                        <span id="variant-stock"></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main">
                                        <label for=""> <strong>Đơn giá:</strong> </label>

                                        <?php if($product->price_sale > 0 && $product->price_sale < $product->base_price): ?>
                                            <span
                                                class="new_price text-danger"><?php echo e(number_format($product->price_sale, 0, ',', '.')); ?>

                                                VND</span>
                                            <span class="old_price text-muted" style="text-decoration: line-through;">
                                                <?php echo e(number_format($product->base_price, 0, ',', '.')); ?> VND
                                            </span>
                                        <?php else: ?>
                                            <span class="new_price"><?php echo e(number_format($product->base_price, 0, ',', '.')); ?>

                                                VND</span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <?php if($product->price_sale): ?>
                                        <input type="hidden" name="total_amount"
                                            value="<?php echo e(isset($finalPrice) ? $finalPrice : $product->price_sale); ?>">
                                    <?php elseif($product->base_price): ?>
                                        <input type="hidden" name="total_amount"
                                            value="<?php echo e(isset($finalPrice) ? $finalPrice : $product->base_price); ?>">
                                    <?php endif; ?>
                                    <button type="button" id="addToCartBtn" class="btn_1">THÊM VÀO GIỎ HÀNG</button>
                                    <p id="variant-warning" style="color: red; display: none; margin-top: 5px;">Bạn phải
                                        chọn <strong> Màu Sắc, Kích Cỡ </strong></p>
                                    <p id="stock-warning" style="color: red; display: none; margin-top: 5px;">Sản phẩm đã
                                        <strong>Hết Hàng</strong>
                                    </p>
                                </div>


                            </div>
                        </div>
                    </form>
                    <div class="mt-2">
                        <form action="<?php echo e(route('favorites.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <button type="submit" class="btn btn-primary">❤️ Thêm vào yêu thích</button>
                        </form>
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
                                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="comment mb-3 p-3 border rounded">
                                            <div class="d-flex justify-content-between">
                                                <strong><?php echo e($comment->user->name); ?></strong>
                                                <span class="text-muted"><?php echo e($comment->created_at); ?></span>
                                            </div>
                                            <p class="mt-1"><?php echo e($comment->content); ?></p>

                                            <!-- Nút mở form trả lời -->
                                            <button class="btn btn-sm btn-outline-primary reply-toggle">Trả lời</button>

                                            <!-- Danh sách phản hồi -->
                                            <?php if($comment->replies->count() > 0): ?>
                                                <div class="replies ms-4 mt-2 border-start ps-3">
                                                    <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="reply mb-2">
                                                            <strong><?php echo e($reply->user->name); ?></strong>
                                                            <p class="mb-1"><?php echo e($reply->content); ?></p>
                                                            <small class="text-muted"><?php echo e($reply->created_at); ?></small>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Form trả lời (ẩn mặc định) -->
                                            <div class="reply-form mt-2 ms-4" style="display: none;">
                                                <form action="<?php echo e(route('add.reply')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                    <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                                                    <textarea name="content" class="form-control" rows="2" required></textarea>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success mt-2">Gửi</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-secondary mt-2 cancel-reply">Hủy</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- Form bình luận chính -->
                                <h4>Để lại bình luận</h4>
                                <form action="<?php echo e(route('add.comment')); ?>" id="commentForm" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" id="product_id" name="product_id"
                                        value="<?php echo e($product->id); ?>">
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
                                            <h4>Thông tin sản phẩm:</h4> <?php echo e($product->name); ?>

                                            <h4>Đặc Điểm Nổi Bật:</h4> <?php echo e($product->content); ?>



                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="product-specs">
                                            <h4>Hướng dẫn sử dụng</h4>
                                            <p><?php echo e($product->user_manual); ?></p>
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
                <h2>SẢN PHẨM CÙNG DANH MỤC</h2>
                <span>SẢN PHẨM CÙNG DANH MỤC</span>
            </div>
            <div class="owl-carousel owl-theme products_carousel">

                <?php if($relatedProducts->isNotEmpty()): ?>
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="grid_item">
                                <span class="ribbon new">New</span>
                                <figure>
                                    <a href="<?php echo e(route('productDetail', $related->slug)); ?>">
                                        <img class="owl-lazy" src="<?php echo e(Storage::url($related->img_thumbnail)); ?>"
                                            data-src="<?php echo e(Storage::url($related->img_thumbnail)); ?>" alt="">
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                        class="icon-star voted"></i><i class="icon-star voted"></i><i
                                        class="icon-star"></i>
                                </div>
                                <a href="product-detail-1.html">
                                    <h3><?php echo e($related->name); ?></h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price"><?php echo e(number_format($related->price_sale, 0, ',', '.')); ?>

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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h3 class="">KHÔNG CÓ SẢN PHẨM CÙNG DANH MỤC</h3>
                <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <link href="client/css/product_page.css" rel="stylesheet">
    <link href="<?php echo e(asset('client')); ?>/css/product_page.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('client')); ?>/js/carousel_with_thumbs.js"></script>
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
                <?php echo json_encode($product->variants, 15, 512) ?>.forEach(variant => {
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
        // cách dòng trong mô tả
        document.addEventListener("DOMContentLoaded", function() {
            let productContent = document.querySelector(".product-description p");
            if (productContent) {
                productContent.innerHTML = productContent.innerHTML.replace(/\.\s*/g, '.<br>');
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.btn-favorite').addEventListener('click', function() {
                let productId = this.getAttribute('data-product');

                fetch('/favorites', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => alert(data.message));
            });
        });
    </script>

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addToCartBtn = document.getElementById("addToCartBtn");
            const variantWarning = document.getElementById("variant-warning");
            const stockWarning = document.getElementById("stock-warning");
            const stockElement = document.getElementById("variant-stock"); // Lấy phần hiển thị tồn kho

            addToCartBtn.addEventListener("click", function() {
                let allSelected = true;
                let stockQuantity = 0; // Mặc định là hết hàng

                // Kiểm tra xem tất cả các nhóm thuộc tính đã được chọn chưa
                document.querySelectorAll(".option-group").forEach(group => {
                    let checkedRadio = group.querySelector(".option-input:checked");
                    if (!checkedRadio) {
                        allSelected = false;
                    }
                });

                // Kiểm tra tồn kho từ `variant-stock` (tìm số lượng cụ thể)
                if (stockElement && stockElement.textContent.match(/\d+/)) {
                    stockQuantity = parseInt(stockElement.textContent.match(/\d+/)[
                        0]); // Lấy số lượng tồn kho
                }

                if (!allSelected) {
                    variantWarning.style.display = "block";
                    stockWarning.style.display = "none";
                } else if (stockQuantity <= 0) {
                    variantWarning.style.display = "none";
                    stockWarning.style.display = "block";
                } else {
                    variantWarning.style.display = "none";
                    stockWarning.style.display = "none";
                    let form = addToCartBtn.closest("form");
                    if (form) {
                        form.submit();
                    }
                }
            });
        });
    </script>

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll(".option-input");
            const stockElement = document.getElementById("variant-stock");

            radios.forEach((radio) => {
                radio.addEventListener("change", function() {
                    updateStock();
                });
            });

            function updateStock() {
                let selectedAttributes = {};
                document.querySelectorAll(".option-input:checked").forEach((radio) => {
                    selectedAttributes[radio.dataset.attribute] = radio.value;
                });

                let stock = getStock(selectedAttributes);
                stockElement.textContent = stock > 0 ? `Còn ${stock} sản phẩm` : "Hết hàng";
                stockElement.style.color = stock > 0 ? "#28a745" : "#d9534f";
            }

            function getStock(selectedAttributes) {
                let variants = <?php echo json_encode(
                    $product->variants->map(function ($variant) {
                        return [
                            'id' => $variant->id, 'attributes' => $variant->attributes->mapWithKeys(function ($attr) {
                                return [Str::slug($attr->attribute->name) => $attr->attributeValue->id];
                            }), 'stock' => $variant->quantity) ?>;

                let matchingVariant = variants.find(variant => {
                    return Object.entries(selectedAttributes).every(([key, value]) => {
                        return variant.attributes[key] == value;
                    });
                });

                return matchingVariant ? matchingVariant.stock : 0;
            }
        });

        /* Cập nhật số lượng */
        function changeQuantity(amount) {
            let quantityInput = document.getElementById("quantity");
            let currentValue = parseInt(quantityInput.value) || 1;
            let newValue = Math.max(1, currentValue + amount);
            quantityInput.value = newValue;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/product/productDetail.blade.php ENDPATH**/ ?>