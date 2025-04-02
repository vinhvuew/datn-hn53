<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h1 class="text-center mb-4">💳 Thống Kê Phương Thức Thanh Toán</h1>

        <canvas id="phuongThucThanhToanChart"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('phuongThucThanhToanChart').getContext('2d');
            var phuongThucThanhToanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($doanhThuTheoThanhToan->pluck('payment_method'), 15, 512) ?>,
                    datasets: [{
                        label: 'Doanh thu theo phương thức thanh toán',
                        data: <?php echo json_encode($doanhThuTheoThanhToan->pluck('doanh_thu'), 15, 512) ?>,
                        backgroundColor: '#36A2EB',
                        borderColor: '#36A2EB',
                        borderWidth: 1
                    }]
                }
            });
        </script>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/thongke/phuongthucthanhtoan.blade.php ENDPATH**/ ?>