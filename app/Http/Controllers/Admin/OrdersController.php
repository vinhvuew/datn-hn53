<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\ProveRefund;
use App\Models\ReturnOrder;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Status_order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    const OBJECT = 'orders';
    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $query = Order::query();

        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // public function bulkUpdateStatus(Request $request,)
    // {

    //     $request->validate([
    //         'order_ids' => 'required|array',
    //         'new_status' => 'required|string',
    //     ]);

    //     Order::whereIn('id', $request->order_ids)->update([
    //         'status' => $request->new_status
    //     ]);

    //     return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái thành công!');
    // }
    private function mapStatusToName($status)
    {
        return [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Xác nhận đơn hàng',
            'shipping' => 'Đang giao hàng',
            'delivered' => 'Đơn hàng đã được nhận',
            'completed' => 'Hoàn tất đơn hàng',
            'canceled' => 'Người mua đã hủy',
            'admin_canceled' => 'Admin đã hủy',
            'return_request' => 'Yêu cầu trả hàng',
            'refuse_return' => 'Từ chối trả hàng',
            'sent_information' => 'Thông tin hoàn tiền',
            'return_approved' => 'Chấp nhận trả hàng',
            'returned_item_received' => 'Đã nhận hàng trả lại',
            'refund_completed' => 'Hoàn tiền thành công',
        ][$status] ?? ucfirst($status);
    }

    public function bulkUpdateStatus(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'order_ids' => 'required|array',
            'new_status' => 'required|string',
        ]);

        // Cập nhật trạng thái
        foreach ($request->order_ids as $orderId) {
            $order = Order::find($orderId);
            if ($order) {
                $order->status = $request->new_status;
                $order->save();

                // Ghi lại timeline event
                Shipping::create([
                    'order_id' => $order->id,
                    'name' => $this->mapStatusToName($request->new_status), // Tên hiển thị trong timeline
                    'note' => 'Trạng thái được cập nhật hàng loạt',
                    'created_at' => now(),
                ]);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái và timeline thành công!');
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
        $rufund = ReturnOrder::where('order_id', $id)->first();
        $prove_refunds = $rufund ? ProveRefund::query()->where('return_order_id', $rufund->id)->get() : null;

        return view('admin.orders.show', compact('order', 'rufund', 'events', 'prove_refunds'));
    }


    public function edit($id)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
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
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
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
        // dd($order);
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

    public function return_request($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        if ($order->status === 'return_request') {
            $order->update([
                'status' => 'return_approved',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Yêu cầu trả hàng được xác nhận',
                'note' => 'Vui lòng đóng gói sản phẩm để đơn vị vận chuyến đến lấy'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái trả hàng!');
    }

    public function refuse_return(Request $request, string $id)
    {
        try {
            $request->validate([
                'note' => 'required'
            ], [
                'note.required' => 'Vui lòng nhập lý do từ chối'
            ]);

            $order = Order::findOrFail($id);
            if ($order->status === 'return_request') {
                $order->update([
                    'status' => 'refuse_return',
                ]);
                Shipping::create([
                    'order_id' => $order->id,
                    'name' => 'Yêu cầu trả hàng bị từ chối',
                    'note' => $request->note
                ]);
            } else {
                return back()->with('error', 'Cập nhật trạng thái thất bại!');
            }
            return back()->with('success', 'Cập nhật trạng thái trả hàng!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Lỗi, vui lòng kiểm tra lại!');
        }
    }
    public function returned_item_received($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'return_approved') {
            $order->update([
                'status' => 'returned_item_received',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Kiểm tra hàng hoàn',
                'note' => 'Đang kiểm tra hàng hoàn'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái kiểm tra hàng hoàn!');
    }
    public function refund_completed(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::findOrFail($id);
        if ($order->status === 'returned_item_received' || $order->status === 'sent_information') {
            $order->update([
                'status' => 'refund_completed',
            ]);
            if ($request->hasFile('image')) {
                $imagePath = Storage::put('Shipping', $request->file('image'));
            }

            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đã hoàn tiền',
                'note' => 'Đã hoàn tiền thành công',
                'image' => $imagePath ?? null,
            ]);

        } else {
            return back()->with('error', 'Hoàn tiền thất bại!');
        }
        return back()->with('success', 'Hoàn tiền thành công!');
    }
}
