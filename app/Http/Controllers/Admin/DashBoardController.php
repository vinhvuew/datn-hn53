<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function dashBoard(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;

        // Lấy danh sách trạng thái đơn hàng
        $statusList = Order::getStatusList();

        // Tạo mảng labels chứa các trạng thái đơn hàng
        $labels = array_values($statusList);
        $data = [];

        // Duyệt từng trạng thái để lấy tổng doanh thu
        foreach (array_keys($statusList) as $status) {
            $data[] = Order::where('status', $status)
                ->whereYear('order_date', $currentYear)
                ->sum('total_price');
        }

        // Tổng doanh thu năm hiện tại
        $totalRevenueCurrentYear = array_sum($data);

        // Tổng doanh thu năm trước
        $totalRevenueLastYear = Order::whereYear('order_date', $lastYear)
            ->where('status', Order::COMPLETED)
            ->sum('total_price');

        // 🔹 Lấy số lượng sản phẩm mới theo ngày
        $productsPerDay = Product::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(id) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $totalCustomers = User::count(); // Đếm số lượng người dùng
        // Lấy top 10 sản phẩm bán chạy theo tháng + năm
        $selectedMonth = $request->input('month') ?? date('m');
        $selectedYear = $request->input('year') ?? date('Y');

        $topSellingProducts = DB::table('order_details')
            ->select('product_name', DB::raw('SUM(quantity) as total_sold'))
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();
        // khách mùa hàng chi tiêu nhiều nhất
        $topCustomer = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', DB::raw('SUM(orders.total_price) as total_spent'), DB::raw('COUNT(orders.id) as total_orders'))
            ->where('orders.status', 'order_confirmation')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();
        return view('admin.dashboard', compact(
            'totalRevenueCurrentYear',
            'totalRevenueLastYear',
            'currentYear',
            'lastYear',
            'labels',
            'data',
            'productsPerDay',
            'totalCustomers',
            'topSellingProducts',
            'selectedMonth',
            'selectedYear',
            'topCustomer'
            // Truyền dữ liệu về view
        ));
    }
}
