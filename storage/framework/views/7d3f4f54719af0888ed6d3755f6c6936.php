<?php $__env->startSection('content'); ?>
<div class="container my-5 p-4 bg-light rounded shadow-sm">
    <h1 class="text-center mb-4 text-primary fw-bold">📊 Thống Kê Doanh Thu</h1>

    <div class="text-center mb-4">
        <label for="dateFilter" class="form-label fw-semibold">📅 Chọn khoảng thời gian:</label>
        <input type="date" id="dateFilter" class="form-control mx-auto border border-primary" style="max-width: 300px;">
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            ✔️ <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            ❌ <?php echo e(session('error')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="text-center mb-4">
        <label for="tableSelector" class="form-label fw-semibold">📂 Chọn loại thống kê:</label>
        <select id="tableSelector" class="form-select w-50 mx-auto border-primary">
            <option value="doanhThuNgay">📅 Theo ngày</option>
            <option value="doanhThuTuan">📆 Theo tuần</option>
            <option value="doanhThuThang">🗓️ Theo tháng</option>
            <option value="doanhThuNam">📈 Theo năm</option>
        </select>
    </div>

    <div class="my-5">
        <h3 class="text-center text-success fw-bold">📈 Biểu đồ Doanh Thu</h3>
        <canvas id="doanhThuChart" height="100"></canvas>
    </div>

    <div class="table-responsive my-4">
        <?php $__currentLoopData = ['Ngay'=>'success', 'Tuan'=>'info', 'Thang'=>'warning', 'Nam'=>'danger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div id="doanhThu<?php echo e($type); ?>" class="data-table <?php echo e($type != 'Ngay' ? 'd-none' : ''); ?>">
            <h3 class="text-center text-white bg-<?php echo e($color); ?> p-2 rounded">📅 Doanh thu theo <?php echo e(strtolower($type)); ?></h3>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        <?php if($type == 'Thang'): ?> <th>Tháng</th><th>Năm</th> <?php elseif($type == 'Tuan'): ?> <th>Tuần</th> <?php else: ?> <th><?php echo e($type == 'Nam' ? 'Năm' : 'Ngày'); ?></th> <?php endif; ?>
                        <th>Doanh thu (VNĐ)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = ${'doanhThu' . $type}; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if($type == 'Thang'): ?> <td><?php echo e($item->thang); ?></td><td><?php echo e($item->nam); ?></td>
                            <?php elseif($type == 'Tuan'): ?> <td>Tuần <?php echo e($item->tuan); ?></td>
                            <?php else: ?> <td><?php echo e($item->{strtolower($type)}); ?></td> <?php endif; ?>
                            <td><?php echo e(number_format($item->doanh_thu)); ?> VNĐ</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .fade-in { animation: fadeIn 0.5s ease-in-out; }
    @keyframes fadeIn { from {opacity:0; transform:scale(0.97);} to {opacity:1; transform:scale(1);} }
</style>
<script>
    const chart = new Chart(document.getElementById('doanhThuChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($doanhThuNgay->pluck('ngay'), 15, 512) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?php echo json_encode($doanhThuNgay->pluck('doanh_thu'), 15, 512) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: {
                    label: ctx => ctx.dataset.label + ': ' + Number(ctx.raw).toLocaleString() + ' VNĐ'
                }}
            },
            scales: { y: {
                beginAtZero: true,
                ticks: {
                    callback: val => val.toLocaleString() + ' VNĐ'
                }
            }}
        }
    });

    document.getElementById('tableSelector').addEventListener('change', e => {
        document.querySelectorAll('.data-table').forEach(t => t.classList.add('d-none'));
        const val = e.target.value;
        const showTable = document.getElementById(val);
        showTable.classList.remove('d-none');
        showTable.classList.add('fade-in');

        let labels = [], data = [];
        switch (val) {
            case 'doanhThuNgay':
                labels = <?php echo json_encode($doanhThuNgay->pluck('ngay'), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuNgay->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuTuan':
                labels = <?php echo json_encode($doanhThuTuan->pluck('tuan')->map(fn($t) => 'Tuần ' . $t), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuTuan->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuThang':
                labels = <?php echo json_encode($doanhThuThang->map(fn($i) => $i->thang . '/' . $i->nam), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuThang->pluck('doanh_thu'), 15, 512) ?>;
                break;
            case 'doanhThuNam':
                labels = <?php echo json_encode($doanhThuNam->pluck('nam'), 15, 512) ?>;
                data = <?php echo json_encode($doanhThuNam->pluck('doanh_thu'), 15, 512) ?>;
                break;
        }
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/thongke/index.blade.php ENDPATH**/ ?>