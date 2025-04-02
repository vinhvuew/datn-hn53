<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h1 class="text-center mb-4">📦 Thống Kê Sản Phẩm Trong Kho</h1>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <canvas id="sanPhamTrongKhoChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('sanPhamTrongKhoChart').getContext('2d');
            var sanPhamTrongKhoChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Sản phẩm hết hàng', 'Sản phẩm còn lại'],
                    datasets: [{
                        label: 'Sản phẩm trong kho',
                        data: [<?php echo e($sanPhamHetHang); ?>, <?php echo e($sanPhamConLai); ?>],
                        backgroundColor: ['#FF6384', '#36A2EB'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleColor: '#fff',
                            bodyColor: '#fff'
                        }
                    }
                }
            });
        </script>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/thongke/sanphamtrongkho.blade.php ENDPATH**/ ?>