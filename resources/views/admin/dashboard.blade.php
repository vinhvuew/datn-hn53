@extends('admin.layouts.master')
@section('item-dashboards', 'active')

@section('content')
<form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
    <label> Từ ngày:
        <input type="date" name="start_date" value="{{ request('start_date') }}">
    </label>
    <label> Đến ngày:
        <input type="date" name="end_date" value="{{ request('end_date') }}">
    </label>
    <button type="submit">Lọc</button>
</form>

<div class="container">
    <ul>
        <li><strong>Tổng số đơn hàng hoàn thành:</strong> {{ $totalOrders }}</li>
        <li><strong>Tổng doanh thu:</strong> {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</li>
        <li><strong>Tổng sản phẩm đã bán:</strong> {{ $totalProductsSold }}</li>
        <li><strong>Tổng lợi nhuận:</strong> {{ number_format($totalProfit, 0, ',', '.') }} VNĐ</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-6">
        <h4>Biểu đồ Doanh thu</h4>
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
    <div class="col-md-6">
        <h4>Biểu đồ Lợi nhuận</h4>
        <canvas id="profitChart" width="400" height="200"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ Doanh thu - Dạng cột (Bar Chart)
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar', // Đổi từ line sang bar
        data: {
            labels: @json(array_keys($orderStats->toArray())),  // Các ngày
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json(array_values($orderStats->toArray())), // Dữ liệu doanh thu
                backgroundColor: 'rgba(75, 192, 192, 0.7)', // Màu nền của cột
                borderColor: 'rgba(75, 192, 192, 1)', // Màu viền của cột
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value.toLocaleString(); } // Định dạng số
                    }
                }
            }
        }
    });

    // Biểu đồ Lợi nhuận - Dạng cột (Bar Chart)
    const profitCtx = document.getElementById('profitChart').getContext('2d');
    new Chart(profitCtx, {
        type: 'bar', // Đổi từ line sang bar
        data: {
            labels: @json(array_keys($profitStats->toArray())), // Các ngày
            datasets: [{
                label: 'Lợi nhuận (VNĐ)',
                data: @json(array_values($profitStats->toArray())), // Dữ liệu lợi nhuận
                backgroundColor: 'rgba(255, 99, 132, 0.7)', // Màu nền của cột
                borderColor: 'rgba(255, 99, 132, 1)', // Màu viền của cột
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value.toLocaleString(); } // Định dạng số
                    }
                }
            }
        }
    });
</script>

@endsection
