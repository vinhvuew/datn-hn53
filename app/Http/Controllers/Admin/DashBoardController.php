<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function dashboard(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        // Điều kiện thời gian
        $orderQuery = Order::where('status', 'order_confirmation');
    
        if ($startDate) {
            $orderQuery->whereDate('completed_at', '>=', $startDate);
        }
    
        if ($endDate) {
            $orderQuery->whereDate('completed_at', '<=', $endDate);
        }
    
        $filteredOrderIds = $orderQuery->pluck('id');
    
        // Tổng số đơn
        $totalOrders = $filteredOrderIds->count();
    
        // Tổng doanh thu
        $totalRevenue = Order::whereIn('id', $filteredOrderIds)->sum('total_price');
    
        // Tổng sản phẩm đã bán
        $totalProductsSold = OrderDetail::whereIn('order_id', $filteredOrderIds)->sum('quantity');
    
        // Tổng lợi nhuận
        $totalProfit = OrderDetail::whereIn('order_id', $filteredOrderIds)
            ->selectRaw('SUM((price - price_old) * quantity) as profit')
            ->value('profit');

        // Dữ liệu doanh thu theo ngày
        $orderStats = Order::where('status', 'order_confirmation')
            ->when($startDate, fn($q) => $q->whereDate('completed_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('completed_at', '<=', $endDate))
            ->selectRaw('DATE(completed_at) as date, SUM(total_price) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('revenue', 'date');

        // Dữ liệu lợi nhuận theo ngày
        $profitStats = OrderDetail::whereIn('order_id', $filteredOrderIds)
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->when($startDate, fn($q) => $q->whereDate('orders.completed_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('orders.completed_at', '<=', $endDate))
            ->selectRaw('DATE(orders.completed_at) as date, SUM((price - price_old) * quantity) as profit')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('profit', 'date');
    
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProductsSold',
            'totalProfit',
            'orderStats',
            'profitStats'
        ));
    }
}
