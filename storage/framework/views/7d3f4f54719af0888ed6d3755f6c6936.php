<?php $__env->startSection('content'); ?>
<div class="container my-5 p-4 bg-light rounded shadow-sm">
    <h1 class="text-center mb-4 text-primary fw-bold">📊 Thống Kê Doanh Thu</h1>

    <!-- Tổng quan doanh thu -->
    <div class="row text-center mb-4">
        <?php
            $summary = [
                
            ];
        ?>
        <?php $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card border-<?php echo e($item['class']); ?> shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-<?php echo e($item['class']); ?> fw-bold"><?php echo e($item['title']); ?></h5>
                        <p class="card-text fs-5"><?php echo e(number_format($item['value'] ?? 0, 0, ',', '.')); ?> VNĐ</p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Bộ chọn loại thống kê -->
    <div class="mb-4 text-center">
        <select id="tableSelector" class="form-select w-50 mx-auto border-primary">
            <option value="doanhThuNgay">📅 Theo ngày</option>
            <option value="doanhThuTuan">📆 Theo tuần</option>
            <option value="doanhThuThang">🗓️ Theo tháng</option>
            <option value="doanhThuNam">📈 Theo năm</option>
        </select>
    </div>

    <!-- Biểu đồ -->
    <canvas id="doanhThuChart" width="600" height="300"></canvas>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    const ctx = document.getElementById('doanhThuChart').getContext('2d');

    // Hàm format tiền VNĐ
    const formatCurrency = val => new Intl.NumberFormat('vi-VN', {
        style: 'decimal',
        maximumFractionDigits: 0
    }).format(val) + ' VNĐ';

    // Lấy dữ liệu mặc định
    let labels = <?php echo json_encode($doanhThuNgay->pluck('ngay'), 15, 512) ?>;
    let data = <?php echo json_encode($doanhThuNgay->pluck('doanh_thu'), 15, 512) ?>;

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: {
                    callbacks: {
                        label: ctx => formatCurrency(ctx.raw)
                    }
                },
                title: {
                    display: true,
                    text: 'Biểu đồ doanh thu',
                    font: { size: 20, weight: 'bold' }
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: val => formatCurrency(val),
                    font: { weight: 'bold', size: 12 },
                    color: '#333'
                }
            },
            scales: {
                x: { grid: { display: true }, ticks: { font: { size: 14 } } },
                y: {
                    beginAtZero: true,
                    grid: { display: true },
                    ticks: {
                        font: { size: 14 },
                        callback: val => formatCurrency(val)
                    }
                }
            }
        }
    });

    document.getElementById('tableSelector').addEventListener('change', e => {
        switch (e.target.value) {
            case 'doanhThuNgay':
                labels = <?php echo json_encode($doanhThuNgay->pluck('ngay'), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuNgay->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuTuan':
                labels = <?php echo json_encode($doanhThuTuan->map(fn($t) => 'Tuần ' . $t->tuan . ' - ' . $t->nam), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuTuan->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuThang':
                labels = <?php echo json_encode($doanhThuThang->map(fn($i) => ($i->thang ?? '??') . '/' . ($i->nam ?? '????')), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuThang->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuNam':
                labels = <?php echo json_encode($doanhThuNam->pluck('nam'), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuNam->pluck('doanh_thu'), 15, 512) ?>;
                break;
        }
        chart.data.labels = [...labels];
        chart.data.datasets[0].data = [...data];
        chart.update();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/thongke/index.blade.php ENDPATH**/ ?>