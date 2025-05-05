<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderStatusUpdated;
use App\Models\Order;
use App\Models\ProveRefund;
use App\Models\ReturnOrder;
use App\Models\Shipping;
use Carbon\Carbon;
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

        $statusFilter = request('status');
        $paymentStatusFilter = request('payment_status');

        // Bắt đầu query
        $query = Order::query();

        // Ưu tiên lọc theo status nếu có
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        } elseif ($paymentStatusFilter) {
            $query->where('payment_status', $paymentStatusFilter);
        }

        // Lấy danh sách đơn hàng (có thể đã được lọc)
        $orders = $query->orderBy('created_at', 'desc')->get();

        // Thống kê tất cả trạng thái (không lọc)
        $statusCounts = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Đếm theo payment_status (nếu cần)
        $payment_status = Order::where('payment_status', 'Chờ thanh toán')->count();

        // Lấy từng biến từ $statusCounts (nếu không tồn tại thì mặc định 0)
        $pending         = $statusCounts['pending'] ?? 0;
        $confirmed       = $statusCounts['confirmed'] ?? 0;
        $shipping        = $statusCounts['shipping'] ?? 0;
        $delivered       = $statusCounts['delivered'] ?? 0;
        $completedCount  = $statusCounts['completed'] ?? 0;
        $refund          = $statusCounts['refund_completed'] ?? 0;
        $canceled        = $statusCounts['canceled'] ?? 0;
        $order_confirmation        = $statusCounts['order_confirmation'] ?? 0;

       

        return view('admin.orders.index', compact(
            'orders',
            'pending',
            'confirmed',
            'shipping',
            'delivered',
            'completedCount',
            'refund',
            'canceled',
            'payment_status',
            'statusFilter',
            'order_confirmation' // để highlight hoặc active tab/filter trên view nếu cần
        ));
    }

    public function updateStatus(Request $request)
    {
        $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);

        $request->validate([
            'order_id' => 'required|array',
            'status' => 'required|string',
        ]);

        try {
            $orders = Order::whereIn('id', $request->order_id)->get();
            $updatedOrderIds = [];

            foreach ($orders as $order) {
                $currentStatus = $order->status;
                $newStatus = $request->status;

                if (
                    ($currentStatus == 'pending' && $newStatus == 'confirmed') ||
                    ($currentStatus == 'confirmed' && $newStatus == 'shipping') ||
                    ($currentStatus == 'shipping' && $newStatus == 'delivered')
                ) {
                    $order->update(['status' => $newStatus]);
                    $updatedOrderIds[] = $order->id;

                    // Gửi event realtime sau khi cập nhật thành công
                    event(new OrderStatusUpdated($order->id, $newStatus, auth()->user()->name));

                    // Tạo ghi chú trạng thái
                    $shippingData = match ($newStatus) {
                        'confirmed' => [
                            'name' => 'Đơn hàng đã được xác nhận',
                            'note' => ''
                        ],
                        'shipping' => [
                            'name' => 'Chờ giao hàng',
                            'note' => 'Đang đợi đơn vị vận chuyển đến lấy hàng'
                        ],
                        'delivered' => [
                            'name' => 'Đang giao hàng',
                            'note' => 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại'
                        ],
                        default => null
                    };

                    if ($shippingData) {
                        Shipping::create(array_merge($shippingData, [
                            'order_id' => $order->id
                        ]));
                    }
                }
            }

            if (count($updatedOrderIds) > 0) {
                return redirect()->back()->with('success', 'Cập nhật trạng thái cho ' . count($updatedOrderIds) . ' đơn hàng thành công!');
            } else {
                return redirect()->back()->with('error', 'Lỗi cập nhật trạng thái hiện tại!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật!');
        }
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
                'note' => '',
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
                'note' => 'Đang chuẩn bị hàng gửi cho đơn vị vận chuyển',
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
                'note' => 'Vui lòng đóng gói sản phẩm để gửi cho đơn vị vận chuyển'
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

    // public function destroy($id)
    // {
    //     try {
    //         $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
    //     } catch (\Throwable $th) {
    //         return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
    //     }
    //     try {
    //         // Tìm đơn hàng theo ID và xóa
    //         DB::table('orders')->where('id', $id)->delete();

    //         // Redirect với thông báo thành công
    //         return redirect()->route('orders')->with('success', 'Xóa đơn hàng thành công!');
    //     } catch (\Exception $e) {
    //         // Trường hợp lỗi
    //         return redirect()->route('orders')->with('error', 'Xóa đơn hàng thất bại!');
    //     }
    // }
}
