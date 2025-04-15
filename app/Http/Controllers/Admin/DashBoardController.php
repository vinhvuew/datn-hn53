<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Tổng số đơn hàng
        $totalOrders = DB::table('orders')->count();

        // Lấy phương thức thanh toán chọn (mặc định là 'cod')
        $selectedMethod = $request->get('method', 'cod');

        // Tổng tiền cho COD và VNPAY
        $totalCodMoney = $this->getTotalPaymentAmount('cod');
        $totalVnpayMoney = $this->getTotalPaymentAmount('vnpay');

        // Tổng tiền đã nhận theo phương thức đã chọn
        $totalMoneyReceived = $selectedMethod === 'cod' ? $totalCodMoney : $totalVnpayMoney;

        // Trả dữ liệu nếu yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'totalCodMoney' => number_format($totalCodMoney, 0, ',', '.'),
                'totalVnpayMoney' => number_format($totalVnpayMoney, 0, ',', '.'),
                'totalMoneyReceived' => number_format($totalMoneyReceived, 0, ',', '.'),
                'selectedMethod' => $selectedMethod,
            ]);
        }

        // Trả lại view cho admin
        return view('admin.dashboard', compact('totalOrders', 'selectedMethod', 'totalMoneyReceived', 'totalCodMoney', 'totalVnpayMoney'));
    }


    public function getTotalPaymentAmount($method)
    {
        // Kiểm tra nếu phương thức là vnpay và xử lý cả "VNPAY_DECOD"
        if ($method === 'vnpay') {
            return DB::table('orders')
                ->whereIn('payment_method', ['vnpay', 'VNPAY_DECOD']) // Kiểm tra cả vnpay và VNPAY_DECOD
                ->sum('total_price');
        }

        // Nếu không phải vnpay, tính bình thường cho COD
        return DB::table('orders')
            ->where('payment_method', $method)
            ->sum('total_price');
    }

}
