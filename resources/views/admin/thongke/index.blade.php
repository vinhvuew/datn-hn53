@extends('admin.layouts.master')

@section('content')
<div class="container my-5 p-4 bg-light rounded shadow-sm">
    <h1 class="text-center mb-4 text-primary fw-bold">📊 Thống Kê Doanh Thu</h1>

    <!-- Tổng quan doanh thu -->
    <div class="row text-center mb-4">
        @php
            $summary = [
                
            ];
        @endphp
        @foreach ($summary as $item)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card border-{{ $item['class'] }} shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-{{ $item['class'] }} fw-bold">{{ $item['title'] }}</h5>
                        <p class="card-text fs-5">{{ number_format($item['value'] ?? 0, 0, ',', '.') }} VNĐ</p>
                    </div>
                </div>
            </div>
        @endforeach
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
@endsection

@section('script-libs')
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
    let labels = @json($doanhThuNgay->pluck('ngay'));
    let data = @json($doanhThuNgay->pluck('doanh_thu'));

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
                labels = @json($doanhThuNgay->pluck('ngay'));
                data = @json($doanhThuNgay->pluck('doanh_thu'));
                break;
            case 'doanhThuTuan':
                labels = @json($doanhThuTuan->map(fn($t) => 'Tuần ' . $t->tuan . ' - ' . $t->nam));
                data = @json($doanhThuTuan->pluck('doanh_thu'));
                break;
            case 'doanhThuThang':
                labels = @json($doanhThuThang->map(fn($i) => ($i->thang ?? '??') . '/' . ($i->nam ?? '????')));
                data = @json($doanhThuThang->pluck('doanh_thu'));
                break;
            case 'doanhThuNam':
                labels = @json($doanhThuNam->pluck('nam'));
                data = @json($doanhThuNam->pluck('doanh_thu'));
                break;
        }
        chart.data.labels = [...labels];
        chart.data.datasets[0].data = [...data];
        chart.update();
    });
</script>
@endsection
