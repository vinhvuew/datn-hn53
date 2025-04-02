<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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

        // Doanh thu theo ngày
        $doanhThuNgay = Order::selectRaw('DATE(order_date) as ngay, SUM(total_price) as doanh_thu')
        ->where('status', 'completed')
            ->groupBy('ngay')
            ->orderBy('ngay', 'DESC')
            ->get();

        // Doanh thu theo tuần
        $doanhThuTuan = Order::selectRaw('YEAR(order_date) as nam, WEEK(order_date, 1) as tuan, SUM(total_price) as doanh_thu')
        ->where('status', 'completed')
        ->groupBy('nam', 'tuan')
            ->orderByDesc('nam')
            ->orderByDesc('tuan')
            ->get();

        // Doanh thu theo tháng
        $doanhThuThang = Order::selectRaw('YEAR(order_date) as nam, MONTH(order_date) as thang, SUM(total_price) as doanh_thu')
        ->where('status', 'completed')
        ->groupBy('nam', 'thang')
            ->orderBy('nam', 'DESC')
            ->orderBy('thang', 'DESC')
            ->get();

        // Doanh thu theo năm
        $doanhThuNam = Order::selectRaw('YEAR(order_date) as nam, SUM(total_price) as doanh_thu')
        ->where('status', 'completed')
        ->groupBy('nam')
            ->orderBy('nam', 'DESC')
            ->get();

        return view('admin.thongke.index', compact('doanhThuNgay', 'doanhThuTuan', 'doanhThuThang', 'doanhThuNam'));
    }
}
