<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    // Hiển thị trang hồ sơ người dùng
    public function index()
    {
        return view('client.users.profile.info', ['user' => Auth::user()]);
    }

    // Hiển thị form chỉnh sửa thông tin
    public function edit()
    {
        return view('client.users.profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin người dùng bằng Query Builder
        DB::table('users')->where('id', $userId)->update($validatedData);

        // Chuyển hướng về trang thông tin người dùng
        return redirect()->route('profile.index', ['id' => $userId])
            ->with('success', 'Thông tin đã được cập nhật.');
    }
    public function updateAvatar(Request $request)
    {
        try {
            // Lấy ID của người dùng hiện tại
            $userId = Auth::id();

            // Xác thực dữ liệu
            $request->validate([
                'avatar' => 'nullable|image|max:2048',
            ]);

            // Xử lý ảnh đại diện
            if ($request->hasFile('avatar')) {
                // Lấy đường dẫn ảnh cũ
                $oldAvatar = DB::table('users')->where('id', $userId)->value('avatar');

                // Xóa ảnh cũ nếu có
                if (!empty($oldAvatar) && Storage::exists('public/' . $oldAvatar)) {
                    Storage::delete('public/' . $oldAvatar);
                }

                // Lưu ảnh mới
                $avatarPath = $request->file('avatar')->store('avatars', 'public');

                // Cập nhật ảnh vào database sử dụng Query Builder
                DB::table('users')->where('id', $userId)->update(['avatar' => $avatarPath]);
            }

            // Chuyển hướng về trang hồ sơ với thông
            return back()->with('success', ' Ảnh đại diện đã được cập nhật!');

            // return redirect()->route('profile.index', ['id' => $userId])
            //     ->with('success', 'Ảnh đại diện đã được cập nhật.');
        } catch (Exception $e) {
            Log::error('Lỗi cập nhật ảnh đại diện: ' . $e->getMessage());
            return redirect()->route('profile.index', ['id' => $userId])
                ->with('error', 'Có lỗi xảy ra khi cập nhật ảnh đại diện.');
        }
    }

    // Cập nhật mật khẩu
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = Auth::user();

        try {
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
            }

            // Cập nhật mật khẩu mới sử dụng Query Builder
            DB::table('users')->where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now()
            ]);

            return back()->with('success', 'Mật khẩu đã được cập nhật thành công!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Đã xảy ra lỗi, vui lòng thử lại sau!']);
        }
    }

    // đơn hàng
    public function myOder(Request $request)
    {
        $user = Auth::user();

        // Lấy danh sách đơn hàng của người dùng kèm theo thông tin sản phẩm và biến thể
        $orders = Order::with([
            'orderDetails.product', // Lấy sản phẩm trong đơn hàng
            'orderDetails.variant.attributes.attribute',
            'orderDetails.variant.attributes.attributeValue' // Lấy biến thể và thuộc tính biến thể
        ])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($orders);
        return view('client.users.profile.order', compact('orders'));
    }

    public function show($id)
    {
        // dd($id);
        $order = Order::query()->with(
            'orderDetails',
            'user',
            'address'
        )->findOrFail($id);
        // dd($orders);
        // dd(gettype($order->order_date), $order->order_date);
        $events = Shipping::where('order_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('client.users.profile.detailOrder', compact('order', 'events'));
    }

    // Xử lý hủy đơn hàng
    public function cancel(Order $order)
    {
        if ($order->status == 'Chờ xác nhận') {
            $order->status = 'Đã hủy';
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        }
        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
    }

    // Xử lý xác nhận đã nhận hàng
    public function confirm(Order $order)
    {
        if ($order->status == 'Giao hàng thành công') {
            $order->status = 'Đã nhận hàng';
            $order->save();
            return redirect()->back()->with('success', 'Bạn đã xác nhận nhận hàng.');
        }
        return redirect()->back()->with('error', 'Không thể xác nhận đơn hàng này.');
    }
}
