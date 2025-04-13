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

        // Lọc theo phương thức thanh toán
        $selectedMethod = $request->get('method', 'cod');  // Mặc định là 'cod'

        // Tính tổng tiền đã nhận cho phương thức thanh toán đã chọn
        $totalCodMoney = $this->getTotalPaymentAmount('cod');  // Tổng tiền của COD
        $totalVnpayMoney = $this->getTotalPaymentAmount('vnpay');  // Tổng tiền của VNPAY

        // Chọn tổng tiền đã nhận dựa trên phương thức thanh toán
        $totalMoneyReceived = $selectedMethod === 'cod' ? $totalCodMoney : $totalVnpayMoney;

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'totalMoneyReceived' => number_format($totalMoneyReceived, 0, ',', '.'),  // Trả về tổng tiền đã nhận
                'selectedMethod' => $selectedMethod  // Trả về phương thức thanh toán đã chọn
            ]);
        }

        // Truyền dữ liệu vào view khi không phải AJAX
        return view('admin.dashboard', compact('totalOrders', 'selectedMethod', 'totalMoneyReceived'));
    }

    // Hàm tính tổng số tiền đã nhận theo phương thức thanh toán
    private function getTotalPaymentAmount($method)
    {
        return DB::table('orders')
            ->where('payment_method', $method)
            ->sum('total_price');  // Tổng số tiền theo phương thức thanh toán
    }
}
