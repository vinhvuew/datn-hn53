<?php $__env->startSection('item-dashboards', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="row">
                <!-- Xin chào mừng (8/12 cột) -->
                <div class="col-lg-8 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body">
                            <h3 class="card-title text-primary">
                                Xin chào  <i><?php echo e(Auth::user()->role); ?></i> 🎉 <i><?php echo e(Auth::user()->name); ?></i>
                            </h3>
                            <p class="mb-0">Bạn đã hoàn thành <span class="fw-medium">72%</span> nhiều doanh số hơn hôm nay.</p>
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
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let totalCustomers = <?php echo e($totalCustomers); ?>;
                    document.getElementById("totalCustomers").innerText = totalCustomers;
            
                    new Chart(document.getElementById("customerChart").getContext("2d"), {
                        type: "doughnut",
                        data: {
                            labels: ["Đã đăng ký"],
                            datasets: [{ data: [totalCustomers], backgroundColor: ["#28a745"] }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: "70%", // Làm nhỏ biểu đồ
                            plugins: {
                                legend: { display: false } // Ẩn chú thích
                            }
                        }
                    });
                });
            </script>
            
            
                <div class="row">
                    <!-- Biểu đồ Doanh Thu Theo Trạng Thái -->
                    <div class="col-12 col-lg-8 order-1 order-lg-1 mb-4">
                        <div class="card h-100 d-flex align-items-stretch">
                            <div class="row row-bordered g-0">
                                <div class="col-md-8">
                                    <h5 class="card-header pb-3">Doanh Thu Theo Trạng Thái (<?php echo e($currentYear); ?>)</h5>
                                    <div class="card-body">
                                        <canvas id="totalRevenueChart" height="250"></canvas> <!-- Biểu đồ -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-label-primary dropdown-toggle" type="button"
                                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <?php echo e($currentYear); ?>

                                            </button>
                                        </div>
                                    </div>
                                    <div id="totalChart"></div>
                                    <div class="text-center fw-medium pt-3">
                                        <span class="text-success">
                                            📈 <?php echo e(number_format($growthPercentage, 2)); ?>% Tăng Trưởng (<?php echo e($currentYear); ?>)
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between px-3 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-primary p-2 me-2"><i class="bx bx-dollar text-primary"></i></span>
                                            <div>
                                                <small><?php echo e($currentYear); ?></small>
                                                <h6 class="mb-0">VND <?php echo e(number_format($totalRevenueCurrentYear, 0)); ?></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-info p-2 me-2"><i class="bx bx-wallet text-info"></i></span>
                                            <div>
                                                <small><?php echo e($lastYear); ?></small>
                                                <h6 class="mb-0">VND <?php echo e(number_format($totalRevenueLastYear, 0)); ?></h6>
                                            </div>
                                        </div>
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
                
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Biểu đồ sản phẩm theo ngày
    let productsData = <?php echo json_encode($productsPerDay, 15, 512) ?>;
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
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Biểu đồ doanh thu theo trạng thái
    new Chart(document.getElementById('totalRevenueChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Doanh thu (VND)',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Biểu đồ tỷ lệ tăng trưởng
    new ApexCharts(document.querySelector("#totalChart"), {
        series: [<?php echo e($growthPercentage); ?>],
        chart: { height: 200, type: "radialBar" },
        plotOptions: {
            radialBar: {
                hollow: { size: "60%" },
                dataLabels: {
                    name: { show: false },
                    value: { fontSize: "20px", color: "#333", formatter: val => val + "%" }
                }
            }
        },
        colors: ["#7367F0"]
    }).render();
});
</script>


            
        </div>
        <div class="row">
            <!-- Order Statistics -->
            
            <!--/ Order Statistics -->

            <!-- Expense Overview -->
            
            <!--/ Expense Overview -->

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Transactions</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('admin')); ?>/assets/img/icons/unicons/paypal.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Paypal</small>
                                        <h6 class="mb-0">Send money</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">+82.6</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('admin')); ?>/assets q q/img/icons/unicons/wallet.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Wallet</small>
                                        <h6 class="mb-0">Mac'D</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">+270.69</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('admin')); ?>/img/icons/unicons/chart.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Transfer</small>
                                        <h6 class="mb-0">Refund</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">+637.91</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/unicons/cc-success.png"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Credit Card</small>
                                        <h6 class="mb-0">Ordered Food</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">-838.71</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/unicons/wallet.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Wallet</small>
                                        <h6 class="mb-0">Starbucks</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">+203.33</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/unicons/cc-warning.png"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Mastercard</small>
                                        <h6 class="mb-0">Ordered Food</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">-92.45</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
            <!-- Activity Timeline -->
            <div class="col-md-12 col-lg-6 order-4 order-lg-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Activity Timeline</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">12 Invoices have been paid</h6>
                                        <small class="text-muted">12 min ago</small>
                                    </div>
                                    <p class="mb-2">
                                        Invoices have been paid to the company
                                    </p>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="d-flex align-items-center me-3">
                                            <img src="<?php echo e(asset('admin')); ?>/assets/img/icons/misc/pdf.png" alt="PDF image"
                                                width="23" class="me-2" />
                                            <h6 class="mb-0">invoices.pdf</h6>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-warning"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Client Meeting</h6>
                                        <small class="text-muted">45 min ago</small>
                                    </div>
                                    <p class="mb-2">
                                        Project meeting with john @10:15am
                                    </p>
                                    <div class="d-flex flex-wrap">
                                        <div class="avatar me-3">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/3.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                            <span>CEO of ThemeSelection</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-info"></span></span>
                                <div class="timeline-event pb-0">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">
                                            Create a new project for client
                                        </h6>
                                        <small class="text-muted">2 Day Ago</small>
                                    </div>
                                    <p class="mb-2">5 team members in a project</p>
                                    <div class="d-flex align-items-center avatar-group">
                                        <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" title="Vinnie Mostowy">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/5.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" title="Marrie Patty">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/12.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" title="Jimmy Jackson">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/9.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" title="Kristine Gill">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/6.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" title="Nelson Wilson">
                                            <img src="<?php echo e(asset('themes')); ?>/admin/img/avatars/14.png" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-end-indicator">
                                <i class="bx bx-check-circle"></i>
                            </li>
                        </ul>
                        <!-- /Activity Timeline -->
                    </div>
                </div>
            </div>
            <!--/ Activity Timeline -->
            <!-- pill table -->
            <div class="col-md-6 order-3 order-lg-4 mb-4 mb-lg-0">
                <div class="card text-center">
                    <div class="card-header py-3">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser"
                                    aria-selected="true">
                                    Browser
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-os" aria-controls="navs-pills-os" aria-selected="false">
                                    Operating System
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-country" aria-controls="navs-pills-country"
                                    aria-selected="false">
                                    Country
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content pt-0">
                        <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                            <div class="table-responsive text-start">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Browser</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/chrome.png"
                                                        alt="Chrome" height="24" class="me-2" />
                                                    <span>Chrome</span>
                                                </div>
                                            </td>
                                            <td>8.92k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 84.75%" aria-valuenow="84.75" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">84.75%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/safari.png"
                                                        alt="Safari" height="24" class="me-2" />
                                                    <span>Safari</span>
                                                </div>
                                            </td>
                                            <td>7.29k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 72.43%" aria-valuenow="72.43" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">72.43%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/firefox.png"
                                                        alt="Firefox" height="24" class="me-2" />
                                                    <span>Firefox</span>
                                                </div>
                                            </td>
                                            <td>6.11k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 67.37%" aria-valuenow="67.37" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">67.37%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/edge.png"
                                                        alt="Edge" height="24" class="me-2" />
                                                    <span>Edge</span>
                                                </div>
                                            </td>
                                            <td>5.08k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 60.12%" aria-valuenow="60.12" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">60.12%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/opera.png"
                                                        alt="Opera" height="24" class="me-2" />
                                                    <span>Opera</span>
                                                </div>
                                            </td>
                                            <td>3.93k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 51.94%" aria-valuenow="51.94" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">51.94%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/brave.png"
                                                        alt="Brave" height="24" class="me-2" />
                                                    <span>Brave</span>
                                                </div>
                                            </td>
                                            <td>3.19k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 39.94%" aria-valuenow="39.94" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">39.94%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/vivaldi.png"
                                                        alt="Vivaldi" height="24" class="me-2" />
                                                    <span>Vivaldi</span>
                                                </div>
                                            </td>
                                            <td>1.29k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 28.43%" aria-valuenow="28.43" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">18.43%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/uc.png"
                                                        alt="UC Browser" height="24" class="me-2" />
                                                    <span>UC Browser</span>
                                                </div>
                                            </td>
                                            <td>328</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 20.14%" aria-valuenow="20.14" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">20.14%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-os" role="tabpanel">
                            <div class="table-responsive text-start">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>System</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/windows.png"
                                                        alt="Windows" height="24" class="me-2" />
                                                    <span>Windows</span>
                                                </div>
                                            </td>
                                            <td>875.24k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 71.5%" aria-valuenow="71.50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">71.50%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/mac.png"
                                                        alt="Mac" height="24" class="me-2" />
                                                    <span>Mac</span>
                                                </div>
                                            </td>
                                            <td>89.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 66.67%" aria-valuenow="66.67" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">66.67%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/ubuntu.png"
                                                        alt="Ubuntu" height="24" class="me-2" />
                                                    <span>Ubuntu</span>
                                                </div>
                                            </td>
                                            <td>37.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 62.82%" aria-valuenow="62.82" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">62.82%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/chrome.png"
                                                        alt="Chrome" height="24" class="me-2" />
                                                    <span>Chrome</span>
                                                </div>
                                            </td>
                                            <td>35.34k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 56.25%" aria-valuenow="56.25" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">56.25%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/cent.png"
                                                        alt="Cent" height="24" class="me-2" />
                                                    <span>Cent</span>
                                                </div>
                                            </td>
                                            <td>32.25k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 42.76%" aria-valuenow="42.76" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">42.76%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/linux.png"
                                                        alt="Linux" height="24" class="me-2" />
                                                    <span>Linux</span>
                                                </div>
                                            </td>
                                            <td>22.15k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 37.77%" aria-valuenow="37.77" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">37.77%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/fedora.png"
                                                        alt="Fedora" height="24" class="me-2" />
                                                    <span>Fedora</span>
                                                </div>
                                            </td>
                                            <td>1.13k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 29.16%" aria-valuenow="29.16" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">29.16%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo e(asset('themes')); ?>/admin/img/icons/brands/vivaldi-os.png"
                                                        alt="Vivaldi" height="24" class="me-2" />
                                                    <span>Vivaldi</span>
                                                </div>
                                            </td>
                                            <td>1.09k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 26.26%" aria-valuenow="26.26" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">26.26%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-country" role="tabpanel">
                            <div class="table-responsive text-start">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Country</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/us.svg"
                                                        alt="USA" height="24" class="me-2" />
                                                    <span>USA</span>
                                                </div>
                                            </td>
                                            <td>87.24k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 89.12%" aria-valuenow="89.12" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">89.12%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/br.svg"
                                                        alt="Brazil" height="24" class="me-2" />
                                                    <span>Brazil</span>
                                                </div>
                                            </td>
                                            <td>62.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 78.23%" aria-valuenow="78.23" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">78.23%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/in.svg"
                                                        alt="India" height="24" class="me-2" />
                                                    <span>India</span>
                                                </div>
                                            </td>
                                            <td>52.58k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 69.82%" aria-valuenow="69.82" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">69.82%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/au.svg"
                                                        alt="Australia" height="24" class="me-2" />
                                                    <span>Australia</span>
                                                </div>
                                            </td>
                                            <td>44.13k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 59.9%" aria-valuenow="59.90" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">59.90%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/de.svg"
                                                        alt="Germany" height="24" class="me-2" />
                                                    <span>Germany</span>
                                                </div>
                                            </td>
                                            <td>32.21k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 57.11%" aria-valuenow="57.11" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">57.11%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/fr.svg"
                                                        alt="France" height="24" class="me-2" />
                                                    <span>France</span>
                                                </div>
                                            </td>
                                            <td>37.87k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 41.23%" aria-valuenow="41.23" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">41.23%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/pt.svg"
                                                        alt="Portugal" height="24" class="me-2" />
                                                    <span>Portugal</span>
                                                </div>
                                            </td>
                                            <td>20.29k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 37.11%" aria-valuenow="37.11" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">37.11%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/svg/flags/cn.svg"
                                                        alt="China" height="24" class="me-2" />
                                                    <span>China</span>
                                                </div>
                                            </td>
                                            <td>12.21k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 17.61%" aria-valuenow="17.61" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">17.61%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ pill table -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style.libs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="<?php echo e(asset('admin')); ?>/assets/js/dashboards-analytics.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>