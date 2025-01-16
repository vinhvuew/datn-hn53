<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
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
                ->join('users', 'orders.id_user', '=', 'users.id')  // Sửa tên cột cho đúng
                ->join('status_order', 'orders.id_status', '=', 'status_order.id')
                ->select('orders.*', 'users.name as user_name', 'status_order.name_status' , 'status_order.payment_method')  // Lấy các cột cần thiết từ cả hai bảng
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
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
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
