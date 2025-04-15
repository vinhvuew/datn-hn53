<?php $__env->startSection('item-dashboards', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            
            <div class="col-lg-8 col-md-4 mb-4">
                <div class="card h-100 ">
                    <div class="card-body">
                        <h3 class="card-title text-primary">
                            Xin chào <i><?php echo e(Auth::user()->role->name); ?></i> 🎉 <i><?php echo e(Auth::user()->name); ?></i>
                        </h3>
                        
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="row">

                    
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card h-100" style="background-color: #d1fae5; min-height: 170px;">
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="icon text-success">
                                        <i class="bx bx-cart" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                <span class="d-block fw-medium mt-4">Tổng Đơn Hàng</span>
                                <h3 class="card-title"><?php echo e($totalOrders); ?></h3>
                            </div>
                        </div>
                    </div>

                   
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <!-- Form chọn phương thức thanh toán -->
                    <form id="paymentMethodForm">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <!-- COD Icon -->
                                <i class="bx bx-wallet-alt fs-4 me-2"></i> <!-- icon ví tiền cho COD -->
                                <select name="method" id="methodSelect" class="form-select">
                                    <option value="cod" <?php echo e($selectedMethod == 'cod' ? 'selected' : ''); ?>>
                                        <i class="bx bx-wallet-alt"></i> COD (Thanh toán khi nhận hàng)
                                    </option>
                                    <option value="vnpay" <?php echo e($selectedMethod == 'vnpay' ? 'selected' : ''); ?>>
                                        <i class="bx bx-credit-card"></i> VNPAY
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Hiển thị tổng số tiền đã nhận -->
                    <h6 id="totalMoneyReceived">Tổng Tiền Đã Nhận: <?php echo e(number_format($totalMoneyReceived, 0, ',', '.')); ?> VND</h6>
                </div>
            </div>
        </div>

                </div>
            </div>

            
            <div class="col-12 col-lg-8 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body text-center">
                                <div class="dropdown mb-3">
                                    <button class="btn btn-sm btn-label-primary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        2022
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">2021</a>
                                        <a class="dropdown-item" href="#">2020</a>
                                        <a class="dropdown-item" href="#">2019</a>
                                    </div>
                                </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-medium pt-3 mb-2">62% Company Growth</div>

                                <div class="d-flex justify-content-between px-3 gap-3">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-primary p-2 me-2"><i
                                                class="bx bx-dollar text-primary"></i></span>
                                        <div>
                                            <small>2022</small>
                                            <h6 class="mb-0">$32.5k</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-info p-2 me-2"><i
                                                class="bx bx-wallet text-info"></i></span>
                                        <div>
                                            <small>2021</small>
                                            <h6 class="mb-0">$41.2k</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 col-md-8 col-lg-4 mb-4">
                <div class="row">
                    
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?php echo e(asset('assets/img/icons/unicons/paypal.png')); ?>" alt="Payments Icon"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span class="d-block mb-1">Payments</span>
                                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-2">
                                <span class="d-block fw-medium mb-1">Revenue</span>
                                <h3 class="card-title mb-1">425k</h3>
                                <div id="revenueChart"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Profile Report</h5>
                                            <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <small class="text-success text-nowrap fw-medium"><i
                                                    class="bx bx-chevron-up"></i> 68.2%</small>
                                            <h3 class="mb-0">$84,686k</h3>
                                        </div>
                                    </div>
                                    <div id="profileReportChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style.libs'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('admin/assets/js/dashboards-analytics.js')); ?>"></script>

    <!-- SweetAlert2 + ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const totalOrders = <?php echo e($totalOrders); ?>; // Đưa giá trị totalOrders vào JavaScript

        // Biểu tượng giỏ hàng lớn
        const iconSize = "4rem"; // Kích thước biểu tượng giỏ hàng

        function showChart() {
            Swal.fire({
                title: 'Tổng số đơn hàng',
                html: '<div id="popupChart" style="height: 300px;"></div>', // Cung cấp vị trí biểu đồ
                width: 600,
                showCloseButton: true,
                showConfirmButton: false,
                didOpen: () => {
                    const options = {
                        chart: {
                            type: 'column', // Biểu đồ cột
                            height: 300,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Tổng đơn',
                            data: [totalOrders]
                        }],
                        xaxis: {
                            categories: ['Tất cả đơn hàng'],
                            labels: {
                                style: {
                                    fontSize: '14px'
                                }
                            }
                        },
                        plotOptions: {
                            column: {
                                width: '50%'
                            }
                        },
                        colors: ['#16a34a'],
                        tooltip: {
                            y: {
                                formatter: val => `${val} đơn hàng`
                            }
                        }
                    };

                    const chart = new ApexCharts(document.querySelector("#popupChart"), options);
                    chart.render();
                }
            });
        }
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý thay đổi phương thức thanh toán
            $('#methodSelect').change(function() {
                var selectedMethod = $(this).val();  // Lấy giá trị phương thức thanh toán được chọn

                // Gửi yêu cầu AJAX đến server
                $.ajax({
                    url: '<?php echo e(route("admin.dashboard")); ?>',  // URL của route xử lý (cập nhật dữ liệu)
                    method: 'GET',
                    data: {
                        method: selectedMethod,  // Gửi phương thức thanh toán
                        _token: '<?php echo e(csrf_token()); ?>'  // Thêm CSRF token bảo mật
                    },
                    success: function(response) {
                        // Cập nhật tổng tiền đã nhận sau khi thành công
                        $('#totalMoneyReceived').text('Tổng Tiền Đã Nhận: ' + response.totalMoneyReceived + ' VND');
                        // Cập nhật giá trị selectedMethod trong select (nếu cần)
                        $('#methodSelect').val(response.selectedMethod);
                    },
                    error: function(xhr, status, error) {
                        alert("Đã xảy ra lỗi. Vui lòng thử lại.");
                    }
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>