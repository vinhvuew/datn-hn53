<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

            return back()->with('successp', 'Mật khẩu đã được cập nhật thành công!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Đã xảy ra lỗi, vui lòng thử lại sau!']);
        }
    }
}
