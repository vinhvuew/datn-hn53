@extends('admin.layouts.master')

@section('content')
<div class="container my-5 p-4 bg-light rounded shadow-sm">
    <h1 class="text-center mb-4 text-primary fw-bold">📊 Thống Kê Doanh Thu</h1>

    <div class="text-center mb-4">
        <label for="dateFilter" class="form-label fw-semibold">📅 Chọn khoảng thời gian:</label>
        <input type="date" id="dateFilter" class="form-control mx-auto border border-primary" style="max-width: 300px;">
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            ✔️ {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            ❌ {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
        @foreach (['Ngay'=>'success', 'Tuan'=>'info', 'Thang'=>'warning', 'Nam'=>'danger'] as $type => $color)
        <div id="doanhThu{{ $type }}" class="data-table {{ $type != 'Ngay' ? 'd-none' : '' }}">
            <h3 class="text-center text-white bg-{{ $color }} p-2 rounded">📅 Doanh thu theo {{ strtolower($type) }}</h3>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        @if ($type == 'Thang') <th>Tháng</th><th>Năm</th> @elseif($type == 'Tuan') <th>Tuần</th> @else <th>{{ $type == 'Nam' ? 'Năm' : 'Ngày' }}</th> @endif
                        <th>Doanh thu (VNĐ)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (${'doanhThu' . $type} as $item)
                        <tr>
                            @if ($type == 'Thang') <td>{{ $item->thang }}</td><td>{{ $item->nam }}</td>
                            @elseif($type == 'Tuan') <td>Tuần {{ $item->tuan }}</td>
                            @else <td>{{ $item->{strtolower($type)} }}</td> @endif
                            <td>{{ number_format($item->doanh_thu) }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script-libs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .fade-in { animation: fadeIn 0.5s ease-in-out; }
    @keyframes fadeIn { from {opacity:0; transform:scale(0.97);} to {opacity:1; transform:scale(1);} }
</style>
<script>
    const chart = new Chart(document.getElementById('doanhThuChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($doanhThuNgay->pluck('ngay')),
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json($doanhThuNgay->pluck('doanh_thu')),
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
                labels = @json($doanhThuNgay->pluck('ngay'));
                data = @json($doanhThuNgay->pluck('doanh_thu'));
                break;
            case 'doanhThuTuan':
                labels = @json($doanhThuTuan->pluck('tuan')->map(fn($t) => 'Tuần ' . $t));
                data = @json($doanhThuTuan->pluck('doanh_thu'));
                break;
            case 'doanhThuThang':
                labels = @json($doanhThuThang->map(fn($i) => $i->thang . '/' . $i->nam));
                data = @json($doanhThuThang->pluck('doanh_thu'));
                break;
            case 'doanhThuNam':
                labels = @json($doanhThuNam->pluck('nam'));
                data = @json($doanhThuNam->pluck('doanh_thu'));
                break;
        }
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    });
</script>
@endsection
