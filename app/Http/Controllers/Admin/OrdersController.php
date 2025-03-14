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

        $query = Order::query();

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
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
        $order = Order::with([
            'orderDetails.product',
            'orderDetails.variant.attributes.attribute',
            'orderDetails.variant.attributes.attributeValue',
            'user',
            'status'
        ])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::with('status_order')->findOrFail($id);
        $statusList = Status_order::all(); // Lấy danh sách trạng thái để chọn
        return view('admin.orders.edit', compact('order', 'statusList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_order_id' => 'required|exists:status_orders,id',
        ]);

        $order = Order::findOrFail($id);
        $currentStatus = $order->status_order_id;
        $newStatus = $request->status_order_id;

        // Danh sách trạng thái không cho phép quay lại (giả sử ID: 2 - Đang giao hàng, 3 - Giao hàng thành công)
        $restrictedStatuses = [3, 4];

        // Kiểm tra nếu đơn hàng đang ở trạng thái hạn chế và muốn quay lại trạng thái cũ
        if (in_array($currentStatus, $restrictedStatuses) && $newStatus < $currentStatus) {
            return redirect()->back()->with('error', 'Không thể quay lại trạng thái trước đó!');
        }

        // Cập nhật trạng thái mới
        $order->status_order_id = $newStatus;
        $order->save();

        return redirect()->route('orders')->with('success', 'Cập nhật trạng thái thành công!');
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
