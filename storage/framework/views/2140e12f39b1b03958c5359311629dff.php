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

        .address-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }

        .address-actions i {
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .address-actions i.ti-pencil:hover {
            color: #007bff;
        }

        .address-actions i.ti-trash:hover {
            color: #dc3545;
        }

        h3 {
            margin-top: 20px;
        }

        .form-voucher {
            background-color: #fff;
            border: 1px solid lightgray;
            padding: 5px;
            display: flex;
            gap: 3px;

        }

        .form-voucher input {
            width: 80%;
            height: 40px;
            border-radius: 5px;
            border: 1px solid lightgray;
        }

        .form-voucher button {
            width: 17%;
            height: 40px;
            font-size: 10px;
            background-color: #333333;
            color: white;
            border: none;
            border-radius: 5px;

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
                                    aria-controls="tab_2" aria-selected="false" > Thêm Địa Chỉ Mới</a>
                            </li>
                        </ul>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div id="addressList">

                                    <?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="address-box">
                                            <input type="radio" name="address" class="address-checkbox"
                                                value="<?php echo e($a->id); ?>" <?php echo e($loop->first ? 'checked' : ''); ?>

                                                onchange="getSelectedAddresses()">
                                            <p><strong><?php echo e($a->full_name); ?></strong></p>
                                            <p>📞 <?php echo e($a->phone); ?></p>
                                            <p>📍 <?php echo e($a->address); ?>, <?php echo e($a->ward); ?>, <?php echo e($a->district); ?>,
                                                <?php echo e($a->province); ?></p>
                                            <div class="address-actions">
                                                <i class="ti-pencil edit-address" data-address-id="<?php echo e($a->id); ?>" title="Sửa địa chỉ"></i>
                                                <i class="ti-trash delete-address" data-address-id="<?php echo e($a->id); ?>" title="Xóa địa chỉ"></i>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!-- /tab_1 -->
                            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2"
                                style="position: relative;">

                                <form id="addressForm" action="<?php echo e(route('addresses.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <input type="hidden" name="address_id" id="edit_address_id">
                                    <div class="form-group">
                                        <label for="full_name">Họ và Tên</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Số Điện Thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
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
                                        <input type="text" class="form-control" name="address" id="address" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Ghi Chú</label>
                                        <textarea class="form-control" name="note" id="note"></textarea>
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

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Tóm Tắt Đơn Hàng</h3>
                        <div class="form-voucher">
                            <input type="text" placeholder="Nhập Voucher ..." id="input-coupon"> <button
                                id="btn-submit-coupon">Áp Dụng</button>
                        </div>
                        <form class="box_general summary" method="POST" action="<?php echo e(route('checkout.store')); ?>"
                            style="margin-top: 5px">
                            <?php echo csrf_field(); ?>
                            <?php $__currentLoopData = $cart->cartDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($order->variant): ?>
                                    
                                    <ul>
                                        <li class="clearfix">
                                            <em><?php echo e($order->quantity); ?>x __  <?php echo e($order->variant->product->name); ?>

                                            </em>
                                            <span><?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                                                VNĐ</span>
                                        </li>
                                    </ul>
                                <?php elseif($order->product): ?>
                                    
                                    <ul>
                                        <li class="clearfix">
                                            <em><?php echo e($order->quantity); ?>x__ <?php echo e($order->product->name); ?></em>
                                            <span><?php echo e(number_format($order->total_amount, 0, ',', '.')); ?> VNĐ</span>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <ul>
                                <li class="clearfix" id="discount_value"><em>Mã giảm giá :</em>
                                    <span>0 VNĐ</span>
                                </li>
                            </ul>
                            <div class="total clearfix" id="total_order">
                                Tổng tiền <span id="total_amount_display"><?php echo e(number_format($totalAmount, 0, ',', '.')); ?>

                                    VNĐ</span>
                            </div>
                            <div class="form-group">
                                <label class="container_check">Register to the Newsletter.
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <input type="hidden" name="total_price" id="total_price" value="<?php echo e($totalAmount); ?>">
                            <input type="hidden" name="address_id" id="address_id"
                                value="<?php echo e(isset($address[0]) ? $address[0]->id : ''); ?>">

                            <input type="hidden" name="payment_method" class="payment_method" value="COD">
                            <input type="hidden" name="voucher_id" id="voucher_id">

                            <button class="btn_1 full-width">Thanh toán</a>
                        </form>
                    </div>
                </div>
             
            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <link href="<?php echo e(asset('client')); ?>/css/checkout.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('client')); ?>/js/common_scripts.min.js"></script>
    <script src="<?php echo e(asset('client')); ?>/js/main.js"></script>
    <script>
        function getSelectedAddresses() {
            document.querySelectorAll('.address-checkbox:checked').forEach(checkbox => {
                document.querySelector('#address_id').value = checkbox.value;
            });
        }
    </script>
    <script>
        const payment_methods = document.querySelectorAll('#payment_method');
        for (const pay of payment_methods) {
            pay.addEventListener('change', () => {
                document.querySelector('.payment_method').value = pay.value;
            })
        }
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const provinceUrl = "https://api.npoint.io/ac646cb54b295b9555be";
            const districtUrl = "https://api.npoint.io/34608ea16bebc5cffd42";
            const wardUrl = "https://api.npoint.io/dd278dc276e65c68cdf5";

            // Hàm gọi API với xử lý lỗi
            const fetchData = (url, successCallback) => {
                $.getJSON(url)
                    .done(successCallback)
                    .fail(() => {
                        alert("Lỗi tải dữ liệu! Vui lòng thử lại.");
                    });
            };

            // Hàm điền dữ liệu vào dropdown và chọn giá trị nếu có
            const populateSelect = (selectId, data, placeholder, valueKey, textKey, selectedValue = '') => {
                let select = $("#" + selectId);
                select.empty().append(`<option value="">${placeholder}</option>`);
                data.forEach(item => {
                    let selected = item[textKey] === selectedValue ? 'selected' : '';
                    select.append(
                        `<option value="${item[valueKey]}" data-text="${item[textKey]}" ${selected}>${item[textKey]}</option>`
                    );
                });
            };

            // Xử lý khi chọn tỉnh
            $("#Province").on("change", function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find("option:selected").data("text");
                $("#province_name").val(provinceName);

                // Xóa dữ liệu cũ của quận/huyện & xã/phường
                $("#District").empty().append(`<option value="">Chọn Quận/Huyện</option>`);
                $("#Ward").empty().append(`<option value="">Chọn Xã/Phường</option>`);

                if (provinceId) {
                    fetchData(districtUrl, data => {
                        let filteredDistricts = data.filter(item => item.ProvinceId == provinceId);
                        populateSelect("District", filteredDistricts, "Chọn Quận/Huyện", "Id",
                            "Name", $("#district_name").val());
                    });
                }
            });

            // Xử lý khi chọn quận/huyện
            $("#District").on("change", function() {
                let districtId = $(this).val();
                let districtName = $(this).find("option:selected").data("text");
                $("#district_name").val(districtName);

                // Xóa dữ liệu cũ của xã/phường
                $("#Ward").empty().append(`<option value="">Chọn Xã/Phường</option>`);

                if (districtId) {
                    fetchData(wardUrl, data => {
                        let filteredWards = data.filter(item => item.DistrictId == districtId);
                        populateSelect("Ward", filteredWards, "Chọn Xã/Phường", "Id", "Name", $("#ward_name").val());
                    });
                }
            });

            // Xử lý khi chọn xã/phường
            $("#Ward").on("change", function() {
                let wardName = $(this).find("option:selected").data("text");
                $("#ward_name").val(wardName);
            });

            // Gọi API khi trang load
            fetchData(provinceUrl, data => {
                populateSelect("Province", data, "Chọn Tỉnh/Thành Phố", "Id", "Name", $("#province_name").val());
            });

            // Xử lý khi click nút sửa địa chỉ
            $('.edit-address').click(function() {
                let addressId = $(this).data('address-id');
                
                // Chuyển sang tab thêm địa chỉ và đổi tên tab
                $('#profile-tab').tab('show');
                $('#profile-tab').text('Sửa Địa Chỉ');
                
                // Gọi API lấy thông tin địa chỉ
                $.ajax({
                    url: `/addresses/${addressId}`,
                    type: 'GET',
                    success: function(response) {
                        // Fill dữ liệu vào form
                        $('#edit_address_id').val(response.id);
                        $('#full_name').val(response.full_name);
                        $('#email').val(response.email);
                        $('#phone').val(response.phone);
                        $('#address').val(response.address);
                        $('#note').val(response.note);
                        
                        // Lưu giá trị tỉnh/huyện/xã vào input ẩn
                        $('#province_name').val(response.province);
                        $('#district_name').val(response.district);
                        $('#ward_name').val(response.ward);
                        
                        // Load và chọn tỉnh
                        fetchData(provinceUrl, data => {
                            populateSelect("Province", data, "Chọn Tỉnh/Thành Phố", "Id", "Name", response.province);
                            
                            // Sau khi load tỉnh, tìm ID tỉnh đã chọn
                            let selectedProvince = $("#Province").val();
                            if(selectedProvince) {
                                // Load và chọn huyện
                                fetchData(districtUrl, districtData => {
                                    let filteredDistricts = districtData.filter(item => item.ProvinceId == selectedProvince);
                                    populateSelect("District", filteredDistricts, "Chọn Quận/Huyện", "Id", "Name", response.district);
                                    
                                    // Sau khi load huyện, tìm ID huyện đã chọn
                                    let selectedDistrict = $("#District").val();
                                    if(selectedDistrict) {
                                        // Load và chọn xã
                                        fetchData(wardUrl, wardData => {
                                            let filteredWards = wardData.filter(item => item.DistrictId == selectedDistrict);
                                            populateSelect("Ward", filteredWards, "Chọn Xã/Phường", "Id", "Name", response.ward);
                                        });
                                    }
                                });
                            }
                        });
                        
                        // Thay đổi text nút submit và action form
                        $('#addressForm button[type="submit"]').text('Cập nhật địa chỉ');
                        $('#addressForm').attr('action', `/addresses/${addressId}`);
                        $('#addressForm').append('<input type="hidden" name="_method" value="PUT">');
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi lấy thông tin địa chỉ');
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#btn-submit-coupon').click(function() {
                let couponCode = $('#input-coupon').val().trim();
                
                // Lấy giá trị từ text hiển thị và xử lý chuỗi
                let totalAmountText = $('#total_amount_display').text().replace('VNĐ', '').trim();
                let totalAmount = totalAmountText.replace(/[,\.]/g, '');
                
                console.log('Total amount text:', totalAmountText);
                console.log('Total amount before sending:', totalAmount);

                if (!couponCode) {
                    alert('Vui lòng nhập mã giảm giá!');
                    return;
                }

                $.ajax({
                    url: "<?php echo e(route('apply.voucher')); ?>",
                    type: "POST",
                    data: {
                        coupon_code: couponCode,
                        total_amount: totalAmount,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        if (response.status === 'success') {
                            // Cập nhật giá trị input ẩn
                            $('#total_price').val(response.final_total);
                            $('#voucher_id').val(response.voucher_id);

                            // Cập nhật hiển thị
                            $('#total_amount_display').text(new Intl.NumberFormat('vi-VN').format(response.final_total) + " VNĐ");
                            $('#discount_value span').text("-" + new Intl.NumberFormat('vi-VN').format(response.discount_amount) + " VNĐ");

                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error response:', xhr.responseText);
                        alert("Có lỗi xảy ra! Vui lòng thử lại.");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Reset form khi chuyển tab
            $('#home-tab').click(function() {
                $('#addressForm')[0].reset();
                $('#edit_address_id').val('');
                $('#addressForm button[type="submit"]').text('Thêm địa chỉ');
                $('#addressForm').attr('action', '<?php echo e(route('addresses.store')); ?>');
                $('#addressForm input[name="_method"]').remove();
                $('#profile-tab').text('Thêm Địa Chỉ Mới');
            });

            // Submit form
            $('#addressForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = $(this).attr('action');
                let method = $('#edit_address_id').val() ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        if(response.success) {
                            alert(response.message);
                            location.reload(); 
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi lưu địa chỉ');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý xóa địa chỉ
            $('.delete-address').click(function() {
                if(confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')) {
                    let addressId = $(this).data('address-id');
                    
                    $.ajax({
                        url: `/addresses/${addressId}`,
                        type: 'DELETE',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            if(response.success) {
                                alert(response.message);
                                location.reload();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Có lỗi xảy ra khi xóa địa chỉ');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        // Xử lý submit form thanh toán
        document.querySelector('.box_general.summary').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const paymentMethod = document.querySelector('.payment_method').value;
            const form = this;
            
            if (paymentMethod === 'VNPAY_DECOD') {
                // Đối với VNPAY, submit form trực tiếp
                form.submit();
            } else {
                // Đối với các phương thức khác, sử dụng AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (paymentMethod === 'COD') {
                            window.location.href = '/checkout/complete';
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra khi xử lý đơn hàng');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xử lý thanh toán. Vui lòng thử lại sau.');
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/Client/checkout/order.blade.php ENDPATH**/ ?>