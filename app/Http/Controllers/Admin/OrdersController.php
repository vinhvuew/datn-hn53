<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Shipping;
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

    public function show($id)
    {
        $order = Order::query()->with(
            'orderDetails',
            'user',
            'address'
        )->findOrFail($id);
        // dd(gettype($order->order_date), $order->order_date);
        $events = Shipping::where('order_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('admin.orders.show', compact('order', 'events'));
    }

    public function cancel(Request $request, $id)
    {
        // dd($request->all());
        try {
            $request->validate([
                'note' => 'required'
            ], [
                'note.required' => 'Vui lòng nhập lý do từ chối'
            ]);

            $order = Order::query()->findOrFail($id);
            if ($order->status === 'pending') {
                $order->update([
                    'status' => 'admin_canceled',
                ]);
                Shipping::create([
                    'order_id' => $order->id,
                    'name' => 'Đơn hàng đã bị hủy',
                    'note' => $request->note
                ]);
            } else {
                return back()->with('error', 'Hủy đơn hàng thất bại!');
            }
            return back()->with('success', 'Đơn hàng đã hủy thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Hủy đơn hàng thất bại!');
        }
    }

    public function confirmed($id)
    {
        // dd($id);
        $order = Order::query()->findOrFail($id);
        if ($order->status !== 'canceled') {
            $order->update([
                'status' => 'confirmed',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đơn hàng đã được xác nhận',
                'note' => 'Đang chuẩn bị hàng gửi cho đơn vị vận chuyển',
            ]);
        } else {
            return back()->with('error', 'Xác nhận đơn hàng thất bại!');
        }
        return back()->with('success', 'Đơn hàng đã được xác nhận!');
    }

    public function shipping($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'confirmed') {
            $order->update([
                'status' => 'shipping',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Chờ giao hàng',
                'note' => 'Đơn hàng đã gửi cho đơn vị vận chuyển',
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái chờ giao hàng!');
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'shipping') {
            $order->update([
                'status' => 'delivered',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đang giao hàng',
                'note' => 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại',
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái đang giao hàng!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::with('status')->findOrFail($id);
        $statusList = Status_order::all(); // Lấy danh sách trạng thái để chọn
        return view('admin.orders.edit', compact('order', 'statusList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuss,id',
        ]);

        $order = Order::findOrFail($id);
        $currentStatus = $order->status_id;
        $newStatus = $request->status_id;

        // Danh sách trạng thái không cho phép quay lại (giả sử ID: 2 - Đang giao hàng, 3 - Giao hàng thành công)
        $restrictedStatuses = [3, 4];

        // Kiểm tra nếu đơn hàng đang ở trạng thái hạn chế và muốn quay lại trạng thái cũ
        if (in_array($currentStatus, $restrictedStatuses) && $newStatus < $currentStatus) {
            return redirect()->back()->with('error', 'Không thể quay lại trạng thái trước đó!');
        }

        // Cập nhật trạng thái mới
        $order->status_id = $newStatus;
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
