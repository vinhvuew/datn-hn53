<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
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

            if (!in_array($user->role_id, [1, 3, 4])) {

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
        $search = $request->input('search');
        $currentUser = Auth::user();

        if (!$currentUser) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        // Lấy danh sách users, ẩn Staff & Accountant nếu admin đã đổi sang các role này
        $users = User::with('role')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            })
            ->when($currentUser->role_id != 1, function ($query) {
                return $query->whereNotIn('role_id', [3, 4]); // Ẩn Staff & Accountant nếu không phải Admin
            })
            ->get();

        $roles = Role::where('id', '!=', 1)->get(); // Không hiển thị Admin trong danh sách role

        return view('admin.users.index', compact('users', 'roles'));
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
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $currentUser = Auth::user();

        // Chỉ Admin mới có quyền thay đổi vai trò
        if ($currentUser->role_id != 1) {
            return response()->json(['message' => 'Bạn không có quyền thay đổi vai trò!'], 403);
        }

        // Không cho phép thay đổi vai trò thành Admin
        if ($request->role_id == 1) {
            return response()->json(['message' => 'Không thể thay đổi vai trò thành Admin!'], 403);
        }

        // Cập nhật vai trò
        $user->role_id = $request->role_id;
        $user->save();

        return response()->json(['message' => 'Cập nhật vai trò thành công!']);
    }
    

    public function destroy(User $user)
{
    try {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Xóa người dùng thành công!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Không thể xóa người dùng.'], 500);
    }
}


    
    
}
