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
    // Hiển thị trang thông tin tài khoản
    public function index()
    {
        return view('client.users.profile', [
            'user' => Auth::user()
        ]);
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id)],
        'phone' => ['nullable', 'numeric', 'digits_between:10,15', Rule::unique('users')->ignore($user->id)],
    ]);

    $user->update($request->only(['name', 'email', 'phone']));

    return back()->with('success', 'Cập nhật thông tin thành công.');
}


    // Cập nhật avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avata' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Xóa avatar cũ nếu có
        if ($user->avata) {
            Storage::delete('public/' . $user->avata);
        }

        // Lưu avatar mới
        $path = $request->file('avata')->store('avatars', 'public');
        $user->avata = $path;
        $user->save();

        return back()->with('success', 'Ảnh đại diện đã được cập nhật!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }
    
        Auth::user()->update(['password' => Hash::make($request->new_password)]);
    
        return back()->with('success', 'Mật khẩu đã được cập nhật');
    }
    
}
