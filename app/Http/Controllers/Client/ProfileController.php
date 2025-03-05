<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    // Hiển thị trang hồ sơ người dùng
    public function index()
    {
        return view('client.users.profile', ['user' => Auth::user()]);
    }

    // Hiển thị form chỉnh sửa thông tin
    public function edit()
    {
        return view('client.users.profile_edit', ['user' => Auth::user()]);
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request)
    {
        $user = Auth::user();

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/', // Chỉ cho phép số điện thoại 10 chữ số
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Phải là 10 số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
        ]);

        // Debug để kiểm tra dữ liệu gửi lên (bỏ comment nếu cần)
        // dd($request->all());

        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect()->route('profile.index')->with('success', 'Cập nhật thông tin thành công.');
    }



    // Cập nhật ảnh đại diện (avatar)
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avata' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Xóa ảnh cũ nếu có
        if ($user->avata) {
            Storage::delete('public/' . $user->avata);
        }

        // Lưu ảnh mới vào thư mục "avatars" trong storage
        $imagePath = $request->file('avata')->store('avatars', 'public');

        // Cập nhật đường dẫn vào DB
        $user->update(['avata' => $imagePath]);

        return response()->json([
            'success' => true,
            'avatar' => asset('storage/' . $imagePath),
        ]);
    }

    // Cập nhật mật khẩu
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng'])
                ->with('tab', 'password'); // Giữ nguyên tab "Đổi mật khẩu"
        }

        // Cập nhật mật khẩu mới
        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Mật khẩu đã được cập nhật.')
            ->with('tab', 'password'); // Giữ nguyên tab "Đổi mật khẩu"
    }
}
