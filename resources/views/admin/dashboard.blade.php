@extends('admin.layouts.master')
@section('item-dashboards', 'active')

@section('content')
    @if (Auth::user()->role_id == 1)
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="row">
                    <!-- Xin chào mừng (8/12 cột) -->
                    <div class="col-lg-8 mb-4">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-body">
                                <h3 class="card-title text-primary">
                                    Xin chào <i>{{ Auth::user()->role->name }}</i> 🎉 <i>{{ Auth::user()->name }}</i>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ tiếp cận khách hàng (4/12 cột) -->
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 d-flex flex-column justify-content-center align-items-center p-3">
                            <h6 class="card-title text-success mb-2">Tiếp cận khách hàng</h6>
                            <h4 id="totalCustomers" class="mb-2">0</h4>
                            <canvas id="customerChart" style="max-width: 80px; max-height: 80px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ Doanh Thu Theo Trạng Thái -->
                <div class="row">

                    <div class="col-12 col-lg-8 order-1 order-lg-1 mb-4">
                        <div class="card h-100 d-flex align-items-stretch">
                            <div class="row row-bordered g-0">
                                <div class="col-md-12">
                                    <h5 class="card-header pb-3">Doanh Thu Theo Trạng Thái ({{ $currentYear }})</h5>
                                    <div class="card-body">
                                        <canvas id="totalRevenueChart" height="250"></canvas> <!-- Biểu đồ -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ sản phẩm mới theo ngày (BÊN PHẢI) -->
                    <div class="col-lg-4 col-md-6 order-2 order-lg-2 mb-4">
                        <div class="card h-100 d-flex align-items-stretch">
                            <div class="card-body pb-3">
                                <span class="d-block fw-medium mb-2">Sản phẩm mới</span>
                                <h3 class="card-title mb-3 text-center" id="totalProducts">0</h3>
                                <canvas id="productChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- top 10 sản phẩm --}}
            <div class="row">
                <div class="card mt-4">
                    <div class="card-header">Top 10 sản phẩm bán chạy của tháng</div>
                    <div class="card-body">
                        <div id="topSellingChart"></div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Top 10 Khách Hàng chi tiêu Nhiều Nhất tháng</div>
                    <div class="card-body">
                        <div id="topCustomersChart"></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Giao diện nhân viên có màu sắc dễ thương --}}
        <div class="container-xxl flex-grow-1 container-p-y d-flex align-items-center justify-content-center"
            style="min-height: 80vh;">
            <div class="card shadow-lg border-0 text-center"
                style="max-width: 500px; width: 100%; background: linear-gradient(135deg, #f8f9fa, #e3f2fd);">
                <div class="card-body py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/2922/2922510.png" alt="Welcome" width="100"
                        class="mb-4">
                    <h2 class="text-primary mb-3">Xin chào, {{ Auth::user()->name }} 🌼</h2>
                    <p class="text-muted">Chào mừng bạn đến với giao diện nhân viên!<br>Hãy kiểm tra đơn hàng hoặc liên hệ
                        quản trị viên nếu cần hỗ trợ.</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary mt-3">🔍 Xem Đơn Hàng</a>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('style.libs')
@endsection

@section('script-libs')
    <script src="{{ asset('admin') }}/assets/js/dashboards-analytics.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    // biểu đồ số lượng người dùng
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let totalCustomers = {{ $totalCustomers }};
            document.getElementById("totalCustomers").innerText = totalCustomers;

            new Chart(document.getElementById("customerChart").getContext("2d"), {
                type: "doughnut",
                data: {
                    labels: ["Đã đăng ký"],
                    datasets: [{
                        data: [totalCustomers],
                        backgroundColor: ["#28a745"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: "70%", // Làm nhỏ biểu đồ
                    plugins: {
                        legend: {
                            display: false
                        } // Ẩn chú thích
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Biểu đồ sản phẩm theo ngày
            let productsData = @json($productsPerDay);
            let labels = productsData.map(item => item.date);
            let values = productsData.map(item => item.total);

            document.getElementById('totalProducts').innerText = values.reduce((a, b) => a + b, 0);

            new Chart(document.getElementById("productChart").getContext("2d"), {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Sản phẩm mới",
                        data: values,
                        borderColor: "rgba(75, 192, 192, 1)",
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Biểu đồ doanh thu theo trạng thái
            new Chart(document.getElementById('totalRevenueChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Doanh thu (VND)',
                        data: {!! json_encode($data) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        });
    </script>
    {{-- top 10 sẩn phẩm bán chạy --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chuyển đổi dữ liệu PHP thành JSON
            const topSellingProducts = @json($topSellingProducts);

            // Tạo danh sách tên sản phẩm và số lượng bán
            const categories = topSellingProducts.map(p => p.product_name);
            const seriesData = topSellingProducts.map(p => p.total_sold);

            // Cấu hình biểu đồ
            const options = {
                chart: {
                    type: 'bar', // Chọn loại biểu đồ
                    height: 350
                },
                series: [{
                    name: 'Số lượng bán',
                    data: seriesData
                }],
                xaxis: {
                    categories: categories
                },
                title: {
                    text: 'Top 10 Sản Phẩm Bán Chạy của tháng',
                    align: 'center'
                }
            };

            // Khởi tạo và vẽ biểu đồ
            new ApexCharts(document.querySelector("#topSellingChart"), options).render();
        });
    </script>
    {{-- khách hàng chi tiêu nhiều nhất --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const topCustomer = @json($topCustomer);

            const names = topCustomer.map(c => c.name);
            const spending = topCustomer.map(c => parseFloat(c.total_spent));

            const options = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Tổng Chi Tiêu',
                    data: spending
                }],
                xaxis: {
                    categories: names,
                    labels: {
                        style: {
                            fontSize: '14px'
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true
                    }
                },
                title: {
                    text: 'Top 10 Khách Hàng chi tiêu Nhiều Nhất',
                    align: 'center',
                    style: {
                        fontSize: '20px'
                    }
                },
                tooltip: {
                    y: {
                        formatter: value => new Intl.NumberFormat('vi-VN').format(value) + '₫'
                    }
                }
            };

            new ApexCharts(document.querySelector("#topCustomersChart"), options).render();
        });
    </script>
@endsection
