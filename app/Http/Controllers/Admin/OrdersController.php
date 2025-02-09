<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Models\Status_order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('status_orders', 'orders.status_order_id', '=', 'status_orders.id')
            ->join('vouchers', 'orders.voucher_id', '=', 'vouchers.id')
            ->select('orders.*', 'users.name as user_name', 'status_orders.status_name', 'vouchers.name as voucher_name')  // Lấy các cột cần thiết từ cả hai bảng
            ->get();
        return view('admin.orders.index', compact('listOrders'));
    }

    /**g
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with(['users', 'status_order', 'vouchers', 'products'])
            ->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Tìm đơn hàng theo ID và xóa
            DB::table('orders')->where('id', $id)->delete();

            // Redirect với thông báo thành công
            return redirect()->route('orders')->with('success', 'Xóa đơn hàng thành công!');
        } catch (\Exception $e) {
            // Trường hợp lỗi
            return redirect()->route('orders')->with('error', 'Xóa đơn hàng thất bại!');
        }
    }
}
