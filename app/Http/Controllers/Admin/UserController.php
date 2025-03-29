<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\search;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';

    public function showAdminLoginForm()
    {
        return view(self::PATH_VIEW . 'logad');
    }

    public function adminLogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'login'    => 'required',
            'password' => 'required|min:6',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        // dd($field);

        if (Auth::attempt([$field => $login, 'password' => $password])) {

            $user = Auth::user();

            if (!in_array($user->role_id, [1, 3, 4, 5])) {

                Auth::logout();
                return back()->with('error', 'Bạn không có quyền truy cập.');
            }
            session(['admin_authenticated' => true]);

            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withInput()->with('error', 'Thông tin đăng nhập không đúng.');
    }

    public function adminLogout()
    {
        session()->forget('admin_authenticated');
        Auth::logout();
        return redirect()->route('logad')->with('success', 'Đăng xuất thành công.');
    }


    public function index(Request $request)
    {
        $query = User::query();

        $search = $request->input('search');

        if (!empty($search)) {
            $query->Where(function ($q) use ($search) {
                $q->Where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        $users = $query->paginate(10);

        return view(self::PATH_VIEW . 'index', compact('users', 'search'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'phone' => 'nullable|numeric|digits_between:10,15|unique:users,phone,' . $id,
            'role'  => 'nullable|in:admin,moderator,user',
            'password' => 'nullable|min:6',
        ]);

        $user->update([
            'name'  => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'phone' => $request->phone ?? $user->phone,
            'role'  => $request->role ?? $user->role,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công.');
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:admin,moderator,user',
        ]);

        $user = User::findOrFail($request->user_id);
        $currentUser = Auth::user();


        if ($currentUser->role !== 'admin') {
            return response()->json(['message' => 'Bạn không có quyền thay đổi vai trò!'], 403);
        }


        if ($currentUser->id == $user->id) {
            return response()->json(['message' => 'Bạn không thể thay đổi vai trò của chính mình!'], 403);
        }


        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Cập nhật vai trò thành công!']);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $id) {
            return back()->with('error', 'Bạn không thể xóa chính mình.');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Không thể xóa tài khoản admin.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
