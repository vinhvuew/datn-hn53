<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';

    
    public function showAdminLoginForm()
    {
        return view(self::PATH_VIEW . 'logad');
    }

   
    public function adminLogin(Request $request)
{
    $request->validate([
        'login'    => 'required',
        'password' => 'required',
    ]);

    $login    = $request->input('login');
    $password = $request->input('password');

  
    $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

   
    $user = User::where($field, $login)->whereIn('role', ['admin', 'moderator'])->first();

    
    if ($user && Auth::attempt([$field => $login, 'password' => $password])) {
        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
    }

    return back()->withInput()->with('error', 'Thông tin đăng nhập không đúng hoặc bạn không có quyền truy cập.');
}

  
    public function adminLogout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Đăng xuất thành công.');
    }

    public function index()
    {
        $users = User::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

  
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        
        $user->name  = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->phone = $request->phone ?? $user->phone;
        $user->role  = $request->role ?? $user->role;
    
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công.');
    }
    

    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
