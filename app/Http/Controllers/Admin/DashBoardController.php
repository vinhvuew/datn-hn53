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

       
        $selectedMethod = $request->get('method', 'cod');  

        
        $totalCodMoney = $this->getTotalPaymentAmount('cod');  
        $totalVnpayMoney = $this->getTotalPaymentAmount('vnpay'); 

        
        $totalMoneyReceived = $selectedMethod === 'cod' ? $totalCodMoney : $totalVnpayMoney;

       
        if ($request->ajax()) {
            return response()->json([
                'totalMoneyReceived' => number_format($totalMoneyReceived, 0, ',', '.'),  
                'selectedMethod' => $selectedMethod  
            ]);
        }

       
        return view('admin.dashboard', compact('totalOrders', 'selectedMethod', 'totalMoneyReceived'));
    }

    
    private function getTotalPaymentAmount($method)
    {
        return DB::table('orders')
            ->where('payment_method', $method)
            ->sum('total_price'); 
    }
}
