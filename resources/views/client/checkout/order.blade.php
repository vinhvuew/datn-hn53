@extends('client.layouts.master')

@section('content')
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
            padding: 15px;
            margin-bottom: 15px;
        }

        .voucher-list {
            max-height: 150px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .voucher-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
            background: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .voucher-item:hover {
            background: #f0f0f0;
            border-color: #999;
        }

        .voucher-info {
            flex: 1;
            padding: 0 10px;
        }

        .voucher-code {
            font-weight: bold;
            color: #e94560;
            font-size: 16px;
        }

        .voucher-name {
            color: #333;
            margin: 5px 0;
        }

        .voucher-condition {
            font-size: 12px;
            color: #666;
        }

        .voucher-item.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #eee;
        }

        .voucher-item.selected {
            border: 2px solid #e94560;
            background: #fff;
        }

        .voucher-radio {
            margin-right: 10px;
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
                                    aria-controls="tab_2" aria-selected="false"> Thêm Địa Chỉ Mới</a>
                            </li>
                        </ul>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div id="addressList">

                                    @foreach ($address as $index => $a)
                                        <div class="address-box">
                                            <input type="radio" name="address" class="address-checkbox"
                                                value="{{ $a->id }}" {{ $loop->first ? 'checked' : '' }}
                                                onchange="getSelectedAddresses()">
                                            <p><strong>{{ $a->full_name }}</strong></p>
                                            <p>📞 {{ $a->phone }}</p>
                                            <p>📍 {{ $a->address }}, {{ $a->ward }}, {{ $a->district }},
                                                {{ $a->province }}</p>
                                            <div class="address-actions">
                                                <i class="ti-pencil edit-address" data-address-id="{{ $a->id }}"
                                                    title="Sửa địa chỉ"></i>
                                                <i class="ti-trash delete-address" data-address-id="{{ $a->id }}"
                                                    title="Xóa địa chỉ"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /tab_1 -->
                            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2"
                                style="position: relative;">

                                <form id="addressForm" action="{{ route('addresses.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                        <input type="text" class="form-control" name="address" id="address"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Ghi Chú</label>
                                        <textarea class="form-control" name="note" id="note"></textarea>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_default"
                                            value="1">
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

                            @foreach ($payment_method as $method)
                                <li>
                                    <label class="container_radio">{{ $method['name'] }}<a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" name="payment" value="{{ $method['value'] }}"
                                            id="payment_method" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Tóm Tắt Đơn Hàng</h3>
                        {{-- voucher --}}
                        <div class="form-voucher">
                            <h5>Chọn Voucher</h5>
                            <div class="voucher-item no-voucher selected" onclick="removeVoucher()">
                                <input type="radio" name="voucher" value="" checked>
                                <div class="voucher-info">
                                    <div class="voucher-code">Không sử dụng voucher</div>
                                </div>
                            </div>

                            <input type="hidden" id="original_total_amount" value="{{ $totalAmount }}">
                            <div class="voucher-list">
                                @foreach ($vouchers as $voucher)
                                    @php
                                        $isDisabled = $voucher->min_order_value > $totalAmount;
                                        $hasBeenUsed = $voucher->hasBeenUsedBy(Auth::user());
                                        $discountText =
                                            $voucher->discount_type === 'percentage'
                                                ? $voucher->discount_value . '%'
                                                : number_format($voucher->discount_value, 0, ',', '.') . ' VNĐ';
                                    @endphp
                                    @if (!$hasBeenUsed)
                                        <div class="voucher-item {{ $isDisabled ? 'disabled' : '' }}"
                                            data-id="{{ $voucher->id }}" data-code="{{ $voucher->code }}"
                                            data-discount-type="{{ $voucher->discount_type }}"
                                            data-discount-value="{{ $voucher->discount_value }}"
                                            data-max-discount="{{ $voucher->max_discount_value ?? 0 }}"
                                            onclick="{{ $isDisabled ? '' : 'selectVoucher(this)' }}">
                                            <input type="radio" name="voucher" value="{{ $voucher->id }}"
                                                class="voucher-radio" {{ $isDisabled ? 'disabled' : '' }}>
                                            <div class="voucher-info">
                                                <div class="voucher-code">{{ $voucher->code }}</div>
                                                <div class="voucher-name">Giảm {{ $discountText }}</div>
                                                <div class="voucher-condition">
                                                    Đơn tối thiểu
                                                    {{ number_format($voucher->min_order_value, 0, ',', '.') }} VNĐ
                                                    @if ($voucher->max_discount_value)
                                                        - Giảm tối đa
                                                        {{ number_format($voucher->max_discount_value, 0, ',', '.') }} VNĐ
                                                    @endif
                                                    @if ($voucher->quantity)
                                                        - Còn lại: {{ $voucher->quantity }} voucher
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <form class="box_general summary" method="POST" action="{{ route('checkout.store') }}"
                            style="margin-top: 5px;">
                            @csrf
                            @foreach ($cart->cartDetails as $order)
                                <div class="order-item">
                                    @if ($order->variant)
                                        {{-- Nếu có biến thể --}}
                                        <div class="item-details">
                                            <strong>{{ $order->variant->product->name }}</strong><br>
                                            <strong>Số lượng: {{ $order->quantity }}</strong><br>
                                            <strong class="text-danger">Giá:
                                                {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</strong>
                                        </div>
                                        @if ($order->variant->attributes->isNotEmpty())
                                            <ul class="variant-attributes">
                                                @foreach ($order->variant->attributes as $variantAttribute)
                                                    <li><strong>{{ $variantAttribute->attribute->name }}:</strong>
                                                        {{ $variantAttribute->attributeValue->value }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span>Không có thuộc tính biến thể</span>
                                        @endif
                                    @elseif ($order->product)
                                        {{-- Nếu không có biến thể, hiển thị thông tin sản phẩm gốc --}}
                                        <div class="item-details">
                                            <strong>{{ $order->quantity }}x {{ $order->product->name }}</strong>
                                            <span>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span>
                                        </div><br>
                                    @endif
                                </div>
                            @endforeach

                            <!-- Mã giảm giá -->
                            <div class="discount-section">
                                <ul>
                                    <li class="clearfix" id="discount_value">
                                        <em>Số tiền giảm:</em>
                                        <span>0 VNĐ</span>
                                    </li>
                                    {{-- <li class="clearfix" id="voucher_info">
                                        <em>Thông tin voucher:</em>
                                        <span id="voucher_quantity"></span>
                                        <button type="button" class="btn btn-sm btn-danger" id="remove_voucher_btn" style="display: none;" onclick="removeVoucher()">Hủy</button>
                                    </li> --}}
                                </ul>
                            </div>

                            <!-- Tổng tiền -->
                            <div class="total mb-2">
                                <em>Tổng tiền:</em>
                                <strong id="total_amount_display">{{ number_format($totalAmount, 0, ',', '.') }}
                                    VNĐ</strong>
                            </div>
                            <!-- Các giá trị ẩn -->
                            <input type="hidden" name="total_price" id="total_price" value="{{ $totalAmount }}">
                            <input type="hidden" name="address_id" id="address_id"
                                value="{{ isset($address[0]) ? $address[0]->id : '' }}">
                            <input type="hidden" name="payment_method" class="payment_method" value="COD">
                            <input type="hidden" name="voucher_id" id="selected_voucher_id">

                            <!-- Nút thanh toán -->
                            <button class="btn_1 full-width">Thanh toán</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
@section('style-libs')
    <link href="{{ asset('client') }}/css/checkout.css" rel="stylesheet">
@endsection

@section('script-libs')
    <script src="{{ asset('client') }}/js/common_scripts.min.js"></script>
    <script src="{{ asset('client') }}/js/main.js"></script>
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
    {{-- địa chỉ --}}
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
                        populateSelect("Ward", filteredWards, "Chọn Xã/Phường", "Id", "Name", $(
                            "#ward_name").val());
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
                populateSelect("Province", data, "Chọn Tỉnh/Thành Phố", "Id", "Name", $("#province_name")
                    .val());
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
                            populateSelect("Province", data, "Chọn Tỉnh/Thành Phố",
                                "Id", "Name", response.province);

                            // Sau khi load tỉnh, tìm ID tỉnh đã chọn
                            let selectedProvince = $("#Province").val();
                            if (selectedProvince) {
                                // Load và chọn huyện
                                fetchData(districtUrl, districtData => {
                                    let filteredDistricts = districtData.filter(
                                        item => item.ProvinceId ==
                                        selectedProvince);
                                    populateSelect("District",
                                        filteredDistricts,
                                        "Chọn Quận/Huyện", "Id", "Name",
                                        response.district);

                                    // Sau khi load huyện, tìm ID huyện đã chọn
                                    let selectedDistrict = $("#District").val();
                                    if (selectedDistrict) {
                                        // Load và chọn xã
                                        fetchData(wardUrl, wardData => {
                                            let filteredWards = wardData
                                                .filter(item => item
                                                    .DistrictId ==
                                                    selectedDistrict);
                                            populateSelect("Ward",
                                                filteredWards,
                                                "Chọn Xã/Phường",
                                                "Id", "Name",
                                                response.ward);
                                        });
                                    }
                                });
                            }
                        });

                        // Thay đổi text nút submit và action form
                        $('#addressForm button[type="submit"]').text('Cập nhật địa chỉ');
                        $('#addressForm').attr('action', `/addresses/${addressId}`);
                        $('#addressForm').append(
                            '<input type="hidden" name="_method" value="PUT">');
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi lấy thông tin địa chỉ');
                    }
                });
            });
        });
    </script>
    {{-- voucher --}}
    <script>
        let selectedVoucherId = null;
        const originalTotal = parseInt(document.getElementById('original_total_amount').value);

        function selectVoucher(element) {
            const voucherId = element.dataset.id;

            // Nếu nhấp lại voucher đang chọn => hủy
            if (selectedVoucherId === voucherId) {
                removeVoucher();
                return;
            }

            // Hủy chọn radio cũ và DOM class 'selected'
            document.querySelectorAll('.voucher-item').forEach(el => el.classList.remove('selected'));
            document.querySelectorAll('.voucher-radio').forEach(radio => radio.checked = false);

            // Chọn radio mới và thêm class selected
            element.classList.add('selected');
            element.querySelector('.voucher-radio').checked = true;

            // Lấy dữ liệu voucher
            const discountType = element.dataset.discountType;
            const discountValue = parseFloat(element.dataset.discountValue);
            const maxDiscount = parseFloat(element.dataset.maxDiscount);

            let discount = 0;

            // Tính toán giảm giá
            if (discountType === 'percentage') {
                discount = (originalTotal * discountValue) / 100;
            } else {
                discount = discountValue;
            }

            // Áp dụng giới hạn giảm giá tối đa nếu có
            if (!isNaN(maxDiscount) && maxDiscount > 0 && discount > maxDiscount) {
                discount = maxDiscount;
            }

            // Cập nhật UI
            document.querySelector('#discount_value span').innerText = numberFormat(discount) + ' VNĐ';
            const newTotal = originalTotal - discount;
            document.querySelector('#total_amount_display').innerText = numberFormat(newTotal) + ' VNĐ';
            document.querySelector('#total_price').value = newTotal;

            // Gán voucher_id vào input hidden
            document.getElementById('selected_voucher_id').value = voucherId;
            selectedVoucherId = voucherId;
        }

        function removeVoucher() {
            document.querySelectorAll('.voucher-item').forEach(el => el.classList.remove('selected'));
            document.querySelectorAll('.voucher-radio').forEach(radio => radio.checked = false);

            // Chọn lại radio "Không dùng voucher"
            const noVoucher = document.querySelector('.no-voucher');
            noVoucher.classList.add('selected');
            noVoucher.querySelector('input[type="radio"]').checked = true;

            // Reset tổng tiền
            document.querySelector('#discount_value span').innerText = '0 VNĐ';
            document.querySelector('#total_amount_display').innerText = numberFormat(originalTotal) + ' VNĐ';
            document.querySelector('#total_price').value = originalTotal;

            // Gán lại input hidden là rỗng
            document.getElementById('selected_voucher_id').value = '';
            selectedVoucherId = null;
        }

        function numberFormat(number) {
            return new Intl.NumberFormat('vi-VN').format(number);
        }
        </script>

    {{-- địa chỉ --}}
    <script>
        $(document).ready(function() {
            // Reset form khi chuyển tab
            $('#home-tab').click(function() {
                $('#addressForm')[0].reset();
                $('#edit_address_id').val('');
                $('#addressForm button[type="submit"]').text('Thêm địa chỉ');
                $('#addressForm').attr('action', '{{ route('addresses.store') }}');
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
                        if (response.success) {
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
                if (confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')) {
                    let addressId = $(this).data('address-id');

                    $.ajax({
                        url: `/addresses/${addressId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.box_general.summary');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const paymentMethod = document.querySelector('.payment_method').value;

                    if (paymentMethod === 'VNPAY_DECOD') {
                        // Đối với VNPAY, submit form trực tiếp
                        this.submit();
                    } else {
                        // Đối với các phương thức khác, sử dụng AJAX
                        fetch(this.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
            }
        });
    </script>
@endsection
