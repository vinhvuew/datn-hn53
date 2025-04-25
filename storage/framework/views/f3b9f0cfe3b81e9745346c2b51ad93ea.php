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
                    <form action="<?php echo e(route('addToCart')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="prod_info">
                            <h1><?php echo e($product->name); ?></h1>
                            
                            <p><small>Mã SP: <?php echo e($product->sku); ?></small><br><?php echo e($product->description); ?></p>
                            <?php if($product->variants->isNotEmpty()): ?>
                                
                                <div class="prod_options">
                                    <div class="row">
                                        <?php
                                            $groupAttribute = [];
                                            $arr = [];
                                        ?>
                                        <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $variant->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
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
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php $__currentLoopData = $groupAttribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeName => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="col-xl-5 col-lg-5 col-md-6 col-6 pt-0">
                                                <strong><?php echo e($attributeName); ?></strong>
                                            </label>
                                            <div class="col-xl-4 col-lg-5 col-md-6 col-6 mb-2">
                                                <select name="variant_attributes[attribute_value_id][]"
                                                    class="form-select attribute-select mb-1"
                                                    data-attribute-name="<?php echo e($attributeName); ?>">
                                                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $variant = $product->variants->firstWhere(function (
                                                                $variant,
                                                            ) use ($value) {
                                                                return $variant->attributes->firstWhere(
                                                                    'attributeValue.id',
                                                                    $value['id'],
                                                                );
                                                            });

                                                            $stock = $variant ? $variant->quantity : 0;
                                                        ?>

                                                        <option value="<?php echo e($value['id']); ?>"
                                                            data-stock="<?php echo e($stock); ?>">
                                                            <?php echo e(Str::limit($value['name'], 30)); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
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

                                    <div class="quantity mt-2">
                                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Tồn kho</strong></label>
                                        <span id="variant-stock" style="margin-left: 87px">
                                            <?php echo e($product->variants->first()->quantity); ?>

                                        </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                
                                <div class="row">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Số lượng</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="quantity" class="qty2"
                                                min="1" name="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity mt-2">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Tồn kho</strong></label>
                                    <span id="product-stock" style="margin-left: 87px">
                                        <?php echo e($product->quantity); ?>

                                    </span>
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
                                    <button class="btn_1">THÊM VÀO GIỎ HÀNG</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-2">
                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('favorites.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <button type="submit" class="btn btn-primary">❤️ Thêm vào yêu thích</button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('login.show')); ?>" class="btn btn-warning">
                                🔒 Đăng nhập để thêm vào yêu thích
                            </a>
                        <?php endif; ?>
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
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Mô tả</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-C" href="#pane-C" class="nav-link" data-bs-toggle="tab" role="tab">Đánh
                            giá</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    
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
                    
                    <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Đánh giá
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if(Auth::check()): ?>
                                            <?php if($product->productReviews->count()): ?>
                                                <?php $__currentLoopData = $product->productReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="review border-bottom py-2">
                                                        <strong><?php echo e($review->user->name ?? 'Người dùng'); ?></strong>
                                                        <div class="stars text-warning">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <i
                                                                    class="bi <?php echo e($i <= $review->rating ? 'bi-star-fill' : 'bi-star'); ?>"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <p><?php echo e($review->review); ?></p>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <p class="alert alert-warning">Chưa có đánh giá nào cho sản phẩm này.</p>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p>Bạn cần đăng nhập để xem!</p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <div class="grid_item"
                                style="min-height: 420px; display: flex; flex-direction: column; justify-content: space-between; padding: 10px; border: 1px solid #eee; border-radius: 8px; background: #fff;">
                                
                                <figure
                                    style="height: 220px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <a href="<?php echo e(route('productDetail', $related->slug)); ?>">
                                        <img class="owl-lazy" src="<?php echo e(Storage::url($related->img_thumbnail)); ?>"
                                            data-src="<?php echo e(Storage::url($related->img_thumbnail)); ?>" alt=""
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </figure>
                                
                                <a href="<?php echo e(route('productDetail', $related->slug)); ?>">
                                    <h3 style="font-size: 1rem; min-height: 48px; ;">
                                        <?php echo e($related->name); ?></h3>
                                </a>
                                <p class="small text-muted flex-grow-1"><?php echo e(Str::limit($related->description, 50)); ?></p>
                                <div class="price_box">
                                    <?php if($related->price_sale): ?>
                                        <span class="old_price text-muted text-decoration-line-through ms-2">
                                            <?php echo e(number_format($related->base_price, 0, ',', '.')); ?>VND
                                        </span>
                                        <span class="new_price text-danger fw-bold">
                                            <?php echo e(number_format($related->price_sale, 0, ',', '.')); ?>VND
                                        </span>
                                    <?php else: ?>
                                        <span class="new_price fw-bold">
                                            <?php echo e(number_format($related->base_price, 0, ',', '.')); ?>VND

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
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
            const quantityInput = document.getElementById("quantity");

            // Chặn nhập giá trị < 1
            quantityInput.addEventListener("input", function() {
                let value = parseInt(this.value);
                if (isNaN(value) || value < 1) {
                    this.value = 1;
                }
            });

            // Giữ nguyên khi nhấn dấu trừ (nếu có custom +/-)
            const wrapper = quantityInput.closest(".numbers-row");
            if (wrapper) {
                wrapper.addEventListener("click", function() {
                    setTimeout(() => {
                        let value = parseInt(quantityInput.value);
                        if (isNaN(value) || value < 1) {
                            quantityInput.value = 1;
                        }
                    }, 50); // Delay nhỏ để đợi input update
                });
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/product/productDetail.blade.php ENDPATH**/ ?>