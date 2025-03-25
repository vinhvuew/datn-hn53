<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function dashBoard()
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

        // Tính phần trăm tăng trưởng
        $growthPercentage = ($totalRevenueLastYear > 0)
            ? (($totalRevenueCurrentYear - $totalRevenueLastYear) / $totalRevenueLastYear) * 100
            : ($totalRevenueCurrentYear > 0 ? 100 : 0);

        // 🔹 Lấy số lượng sản phẩm mới theo ngày
        $productsPerDay = Product::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(id) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            $totalCustomers = User::count(); // Đếm số lượng người dùng

        return view('admin.dashboard', compact(
            'totalRevenueCurrentYear',
            'totalRevenueLastYear',
            'growthPercentage',
            'currentYear',
            'lastYear',
            'labels',
            'data',
            'productsPerDay',
            'totalCustomers'
             // Truyền dữ liệu về view
        ));
    }
}
