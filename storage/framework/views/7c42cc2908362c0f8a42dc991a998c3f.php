<?php $__env->startSection('content'); ?>
    <style>
        .address-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 5px;
            background: #f9f9f9;
            position: relative;
        }

        .address-checkbox {
            position: absolute;
            top: 5px;
            left: 5px;
            transform: scale(1.2);
        }

        h3 {
            margin-top: 20px;
        }
    </style>
    <main class="bg_gray">


        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>Thanh Toán</li>
                    </ul>
                </div>
                <h1>Thanh Toán</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Thông Tin Nhận Hàng</h3>
                        <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab_1" role="tab"
                                    aria-controls="tab_1" aria-selected="true">Chọn Địa Chỉ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab_2" role="tab"
                                    aria-controls="tab_2" aria-selected="false">Thêm Địa Chỉ Mới</a>
                            </li>
                        </ul>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div id="addressList">
                                    <?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="address-box">
                                            <input type="checkbox" class="address-checkbox" value="<?php echo e($a->id); ?>"
                                                onchange="getSelectedAddresses()">
                                            <p><strong><?php echo e($a->full_name); ?></strong></p>
                                            <p>📞 <?php echo e($a->phone); ?></p>
                                            <p>📍 <?php echo e($a->address); ?>, <?php echo e($a->ward); ?>, <?php echo e($a->district); ?>,
                                                <?php echo e($a->province); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!-- /tab_1 -->
                            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2"
                                style="position: relative;">

                                <form action="<?php echo e(route('addresses.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="full_name">Họ và Tên</label>
                                        <input type="text" class="form-control" name="full_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Số Điện Thoại</label>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Province">Tỉnh/Thành Phố</label>
                                        <select id="Province" class="form-control">
                                            <option value="">Chọn Tỉnh/Thành Phố</option>
                                        </select>
                                        <input type="hidden" name="province" id="province_name">
                                        <!-- Input ẩn lưu tên tỉnh -->
                                    </div>

                                    <div class="form-group">
                                        <label for="District">Quận/Huyện</label>
                                        <select id="District" class="form-control">
                                            <option value="">Chọn Quận/Huyện</option>
                                        </select>
                                        <input type="hidden" name="district" id="district_name">
                                        <!-- Input ẩn lưu tên huyện -->
                                    </div>

                                    <div class="form-group">
                                        <label for="Ward">Xã/Phường</label>
                                        <select id="Ward" class="form-control">
                                            <option value="">Chọn Xã/Phường</option>
                                        </select>
                                        <input type="hidden" name="ward" id="ward_name"> <!-- Input ẩn lưu tên xã -->
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Địa Chỉ Cụ Thể</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Ghi Chú</label>
                                        <textarea class="form-control" name="note"></textarea>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_default" value="1">
                                        <label class="form-check-label">Đặt làm địa chỉ mặc định</label>
                                    </div>

                                    <button type="submit" class="btn btn-success mt-3">Thêm Địa Chỉ</button>
                                </form>





                            </div>
                            <!-- /tab_2 -->
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>2. Phương Thức Thanh Toán</h3>
                        <ul>

                            <?php $__currentLoopData = $payment_method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <label class="container_radio"><?php echo e($method['name']); ?><a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" name="payment" value="<?php echo e($method['value']); ?>"
                                            id="payment_method" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>





                    </div>
                    <!-- /step -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Tóm Tắt Đơn Hàng</h3>
                        <form class="box_general summary">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul>
                                    <li class="clearfix"><em><?php echo e($product['quantity']); ?>x <?php echo e($product['name']); ?></em>
                                        <span><?php echo e(number_format($product['total'], 0, ',', '.')); ?> VNĐ</span></li>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="total clearfix">TOTAL <span>$450.00</span></div>
                            <div class="form-group">
                                <label class="container_check">Register to the Newsletter.
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <button class="btn_1 full-width">Place Order</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function getSelectedAddresses() {
                let address = null;
                document.querySelectorAll('.address-checkbox:checked').forEach(checkbox => {
                    selected = checkbox.value;
                });
                console.log("ID Địa chỉ đã chọn:", selected);
            }
        </script>
        <script>
            const payment_methods = document.querySelectorAll('#payment_method');
            //    console.log(payment_method);
            let payment_method = '';
            for (const pay of payment_methods) {
                pay.addEventListener('change', () => {
                    // console.log(pay.value);
                    payment_method = pay.value;

                })
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            const province_url = "https://api.npoint.io/ac646cb54b295b9555be";
            const district_url = "https://api.npoint.io/34608ea16bebc5cffd42";
            const ward_url = "https://api.npoint.io/dd278dc276e65c68cdf5";

            let province_list = [],
                district_list = [],
                ward_list = [];

            const fetchData = (url, callback) => {
                $.getJSON(url, function(data) {
                    callback(data);
                });
            };

            const populateSelect = (selectId, data, placeholder, valueKey, textKey) => {
                let select = $("#" + selectId);
                select.empty().append(`<option value="">${placeholder}</option>`);
                data.forEach(item => {
                    select.append(
                        `<option value="${item[valueKey]}" data-text="${item[textKey]}">${item[textKey]}</option>`
                        );
                });
            };

            $("#Province").on("change", function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find("option:selected").data("text");
                $("#province_name").val(provinceName); 

                $("#District").empty().append(`<option value="">Chọn Quận/Huyện</option>`);
                $("#Ward").empty().append(`<option value="">Chọn Xã/Phường</option>`);

                if (provinceId) {
                    let filteredDistricts = district_list.filter(item => item.ProvinceId == provinceId);
                    populateSelect("District", filteredDistricts, "Chọn Quận/Huyện", "Id", "Name");
                }
            });

            $("#District").on("change", function() {
                let districtId = $(this).val();
                let districtName = $(this).find("option:selected").data("text");
                $("#district_name").val(districtName); 

                $("#Ward").empty().append(`<option value="">Chọn Xã/Phường</option>`);

                if (districtId) {
                    let filteredWards = ward_list.filter(item => item.DistrictId == districtId);
                    populateSelect("Ward", filteredWards, "Chọn Xã/Phường", "Id", "Name");
                }
            });

            $("#Ward").on("change", function() {
                let wardName = $(this).find("option:selected").data("text");
                $("#ward_name").val(wardName);
            });

            const initDropdowns = () => {
                fetchData(province_url, data => {
                    province_list = data;
                    populateSelect("Province", province_list, "Chọn Tỉnh/Thành Phố", "Id", "Name");
                });

                fetchData(district_url, data => {
                    district_list = data;
                });

                fetchData(ward_url, data => {
                    ward_list = data;
                });
            };

            $(document).ready(function() {
                initDropdowns();
            });
        </script>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <link href="<?php echo e(asset('client')); ?>/css/checkout.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('client')); ?>/js/common_scripts.min.js"></script>
    <script src="<?php echo e(asset('client')); ?>/js/main.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/Client/checkout/order.blade.php ENDPATH**/ ?>