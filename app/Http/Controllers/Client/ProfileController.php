<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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

    // Cập nhật thông tin người dùng (Không dùng update() hoặc save())
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

        // Cập nhật thông tin bằng Query Builder
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_at' => now(),
            ]);

        return redirect()->route('profile.index')->with('success', 'Cập nhật thông tin thành công.');
    }

    // Cập nhật ảnh đại diện (avatar) - Không dùng update()
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

        // Cập nhật đường dẫn vào DB bằng SQL thủ công
        DB::statement("UPDATE users SET avata = ?, updated_at = ? WHERE id = ?", [
            $imagePath,
            now(),
            $user->id
        ]);

        return response()->json([
            'success' => true,
            'avatar' => asset('storage/' . $imagePath),
        ]);
    }

    // Cập nhật mật khẩu - Không dùng update()
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
                         ->with('tab', 'password'); 
        }

        
        DB::statement("UPDATE users SET password = ?, updated_at = ? WHERE id = ?", [
            Hash::make($request->new_password),
            now(),
            Auth::id(),
        ]);

        return back()->with('success', 'Mật khẩu đã được cập nhật.')
                     ->with('tab', 'password'); 
    }
}
