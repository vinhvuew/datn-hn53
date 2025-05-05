<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function dashboard(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Lọc đơn hàng theo trạng thái và khoảng thời gian
        $orderQuery = Order::where('status', 'order_confirmation');

        if ($startDate) {
            $orderQuery->whereDate('completed_at', '>=', $startDate);
        }

        if ($endDate) {
            $orderQuery->whereDate('completed_at', '<=', $endDate);
        }

        $filteredOrderIds = $orderQuery->pluck('id');

        // Thống kê cơ bản
        $totalOrders = $filteredOrderIds->count();
        $totalRevenue = Order::whereIn('id', $filteredOrderIds)->sum('total_price');
        $totalProductsSold = OrderDetail::whereIn('order_id', $filteredOrderIds)->sum('quantity');

        $totalProfit = OrderDetail::whereIn('order_id', $filteredOrderIds)
            ->selectRaw('SUM((price - price_old) * quantity) as profit')
            ->value('profit');

        // Doanh thu theo ngày
        $orderStats = Order::where('status', 'order_confirmation')
            ->when($startDate, fn($q) => $q->whereDate('completed_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('completed_at', '<=', $endDate))
            ->selectRaw('DATE(completed_at) as date, SUM(total_price) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('revenue', 'date');

        // Lợi nhuận theo ngày
        $profitStats = OrderDetail::whereIn('order_id', $filteredOrderIds)
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->when($startDate, fn($q) => $q->whereDate('orders.completed_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('orders.completed_at', '<=', $endDate))
            ->selectRaw('DATE(orders.completed_at) as date, SUM((price - price_old) * quantity) as profit')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('profit', 'date');

        // Thống kê voucher
        $totalVouchers = DB::table('vouchers')->count();
        $activeVouchers = DB::table('vouchers')->where('status', 'active')->count();
        $expiredVouchers = DB::table('vouchers')->where('status', 'expired')->count();
        $shippingVouchers = DB::table('vouchers')->where('discount_type', 'shipping')->count();
        $valueVouchers = DB::table('vouchers')->where('discount_type', 'value')->count();

        // Đơn hàng có sử dụng voucher
        $ordersWithVoucher = Order::whereIn('id', $filteredOrderIds)
            ->whereNotNull('voucher_id');

        $voucherUsages = $ordersWithVoucher->count();
        $totalVoucherDiscountAmount = $ordersWithVoucher->sum('voucher_discount_amount');
        $voucherUsers = $ordersWithVoucher->distinct('user_id')->count('user_id');
        $totalBeforeDiscount = $ordersWithVoucher->sum('total_price');
        $totalAfterDiscount = $totalBeforeDiscount - $totalVoucherDiscountAmount;

        $voucherUsageRate = $totalOrders > 0
            ? round(($voucherUsages / $totalOrders) * 100, 2)
            : 0;

        // Top 5 mã được dùng nhiều nhất
        $topVouchers = Order::whereIn('id', $filteredOrderIds)
            ->whereNotNull('voucher_code')
            ->select('voucher_code', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('voucher_code')
            ->orderByDesc('usage_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProductsSold',
            'totalProfit',
            'orderStats',
            'profitStats',
            'totalVouchers',
            'activeVouchers',
            'expiredVouchers',
            'shippingVouchers',
            'valueVouchers',
            'voucherUsages',
            'totalVoucherDiscountAmount',
            'voucherUsers',
            'totalBeforeDiscount',
            'totalAfterDiscount',
            'voucherUsageRate',
            'topVouchers'
        ));
    }
}
