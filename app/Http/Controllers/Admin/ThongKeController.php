<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    const PATH_VIEW = 'admin.thongke.';
    const OBJECT = 'roles';

    public function statistical()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }

        // Doanh thu theo ngày (chỉ hôm nay)
        $doanhThuNgay = Order::selectRaw('DATE(order_date) as ngay, SUM(total_price) as doanh_thu')
            ->where('status', 'completed')
            ->whereDate('order_date', Carbon::today())  // Lọc theo ngày hôm nay
            ->groupBy('ngay')
            ->orderBy('ngay', 'DESC')
            ->get();

        // Doanh thu theo tuần (chỉ tuần hiện tại)
        $doanhThuTuan = Order::selectRaw('YEAR(order_date) as nam, WEEK(order_date, 1) as tuan, SUM(total_price) as doanh_thu')
            ->where('status', 'completed')
            ->whereYear('order_date', Carbon::now()->year)  // Lọc theo năm hiện tại
            ->whereRaw('WEEK(order_date, 1) = ?', [Carbon::now()->week])  // Lọc theo tuần hiện tại
            ->groupBy('nam', 'tuan')
            ->orderByDesc('nam')
            ->orderByDesc('tuan')
            ->get();

        // Doanh thu theo tháng (chỉ tháng hiện tại)
        $doanhThuThang = Order::selectRaw('YEAR(order_date) as nam, MONTH(order_date) as thang, SUM(total_price) as doanh_thu')
            ->where('status', 'completed')
            ->whereYear('order_date', Carbon::now()->year)  // Lọc theo năm hiện tại
            ->whereMonth('order_date', Carbon::now()->month)  // Lọc theo tháng hiện tại
            ->groupBy('nam', 'thang')
            ->orderBy('nam', 'DESC')
            ->orderBy('thang', 'DESC')
            ->get();

        // Doanh thu theo năm (chỉ năm hiện tại)
        $doanhThuNam = Order::selectRaw('YEAR(order_date) as nam, SUM(total_price) as doanh_thu')
            ->where('status', 'completed')
            ->whereYear('order_date', Carbon::now()->year)  // Lọc theo năm hiện tại
            ->groupBy('nam')
            ->orderBy('nam', 'DESC')
            ->get();

        // Trả về view với dữ liệu thống kê
        return view('admin.thongke.index', compact('doanhThuNgay', 'doanhThuTuan', 'doanhThuThang', 'doanhThuNam'));
    }
}
