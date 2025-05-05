<?php $__env->startSection('item-dashboards', 'active'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <form method="GET" action="<?php echo e(route('admin.dashboard')); ?>" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Từ ngày:</label>
            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Đến ngày:</label>
            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Lọc</button>
        </div>
    </form>

    
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng hoàn thành</h5>
                    <p class="card-text fs-4"><?php echo e($totalOrders); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu</h5>
                    <p class="card-text fs-4"><?php echo e(number_format($totalRevenue, 0, ',', '.')); ?> VNĐ</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm đã bán</h5>
                    <p class="card-text fs-4"><?php echo e($totalProductsSold); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-teal-200 text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Lợi nhuận</h5>
                    <p class="card-text fs-4"><?php echo e(number_format($totalProfit, 0, ',', '.')); ?> VNĐ</p>
                </div>
            </div>
        </div>
    </div>

   
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3">Thống kê mã giảm giá</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tổng mã giảm giá</th>
                        <th>Mã đang hoạt động</th>
                        <th>Mã hết hạn</th>
                        <th>Đơn hàng dùng mã</th>
                        <th>Tỷ lệ đơn dùng mã</th>
                        <th>Số người dùng mã</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($totalVouchers); ?></td>
                        <td><?php echo e($activeVouchers); ?></td>
                        <td><?php echo e($expiredVouchers); ?></td>
                        <td><?php echo e($voucherUsages); ?></td>
                        <td><?php echo e(number_format($voucherUsageRate, 2)); ?>%</td>
                        <td><?php echo e($voucherUsers); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


    
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Biểu đồ Doanh thu</h5>
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Biểu đồ Lợi nhuận</h5>
                    <canvas id="profitChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Đảm bảo rằng bạn đã có biến $teal-200 trong SCSS của mình */
    .bg-teal-200 {
    background-color: #64b5f6; /* Thay bằng mã màu của $teal-200 */
}

</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($orderStats->toArray()), 15, 512) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?php echo json_encode(array_values($orderStats->toArray()), 15, 512) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    const profitCtx = document.getElementById('profitChart').getContext('2d');
    new Chart(profitCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($profitStats->toArray()), 15, 512) ?>,
            datasets: [{
                label: 'Lợi nhuận (VNĐ)',
                data: <?php echo json_encode(array_values($profitStats->toArray()), 15, 512) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>