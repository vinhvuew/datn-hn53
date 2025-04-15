<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProveRefund;
use App\Models\ReturnOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RefundController extends Controller
{
    public function refund(string $id)
    {
        $order = Order::query()->findOrFail($id);
        // dd($order);
        return view('client.users.refund.refund', compact('order'));
    }

    public function refundRequests(Request $request)
    {
        // dd($request->all());
        try {
            DB::transaction(function () use ($request) {
                // Xác thực dữ liệu
                $data = $request->validate([
                    'order_id' => 'required',
                    'reason' => 'required',
                    'total_amount' => 'required',
                    'refund_on' => 'required',
                    'note' => 'required',
                    'email' => 'required',
                    'proveRufund.image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'proveRufund.video.*' => 'nullable|mimes:mp4,avi,mov|max:51200',
                ], [
                    'reason.required' => 'Vui lòng chọn lý do hoàn tiền',
                    'total_amount.required' => 'Số tiền hoàn không hợp lệ',
                    'refund_on.required' => 'Vui lòng nhập nơi nhận hoàn',
                    'note.required' => 'Vui lòng nhập lý do chi tiết',
                    'email.required' => 'Vui lòng nhập email',
                    'proveRufund.image.*.required' => 'Vui lòng tải ảnh chứng minh',
                    'proveRufund.video.*.required' => 'Vui lòng tải video chứng minh',
                ]);

                $data['user_id'] = Auth::id();

                // Cập nhật trạng thái đơn hàng
                $order = Order::query()->findOrFail($data['order_id']);
                // dd($order);
                $order->update([
                    'status' => 'return_request',
                ]);

                Shipping::create([
                    'order_id' => $order->id,
                    'name' => 'Yêu cầu trả hàng',
                    'note' => $request->note,
                ]);

                $rufund = ReturnOrder::create($data);

                // Xử lý lưu ảnh
                if ($request->hasFile('proveRufund.image')) {
                    foreach ($request->file('proveRufund.image') as $image) {
                        ProveRefund::create([
                            'return_order_id' => $rufund->id,
                            'image' => Storage::put('images_refund', $image),
                        ]);
                    }
                }

                // Xử lý lưu video
                if ($request->hasFile('proveRufund.video')) {
                    foreach ($request->file('proveRufund.video') as $video) {
                        ProveRefund::create([
                            'return_order_id' => $rufund->id,
                            'video' => Storage::put('videos_refund', $video),
                        ]);
                    }
                }
            }, 3);

            return redirect()->route('profile.myOder')->with('success', 'Yêu cầu hoàn tiền đã được tạo thành công.');
        } catch (\Throwable $th) {
            Log::error('Lỗi khi tạo yêu cầu hoàn tiền: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.');
        }
    }
}
