<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginRegisterController extends Controller
{
    /**
     * Hiển thị trang đăng nhập & đăng ký.
     */
    public function showForm()
    {
        return view('client.users.login');
    }

    /**
     * Xử lý đăng nhập (không sử dụng hàm băm mật khẩu).
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required',
            'password' => 'required|min:6',
        ]);

        $login    = $request->input('login');
        $password = $request->input('password');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($fieldType, $login)->first();

        if ($user && $user->password === $password) {
            Auth::login($user);
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['login' => 'Thông tin đăng nhập không đúng.'])->with('auth_type', 'login');
    }

    /**
     * Xử lý đăng ký (không mã hóa mật khẩu).
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'login'    => 'required',   
            'password' => 'required|min:6|confirmed',
        ]);
    
        $login = $request->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    
        
        if (User::where($fieldType, $login)->exists()) {
            return back()->withErrors([
                'login' => ucfirst($fieldType) . ' đã được sử dụng.'
            ])->with('auth_type', 'register');
        }
    
        
        $user = User::create([
            'name'  => $request->name,
            // Nếu đăng ký bằng email thì gán gtt cho email,số điện thoại thì cho phone.
            'email' => $fieldType === 'email' ? $login : null,
            'phone' => $fieldType === 'phone' ? $login : null,
            'password' => $request->password,
        ]);
    
        
        return redirect()->route('login.register')
                         ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    

    /**
     * Xử lý đăng xuất.
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login.register')->with('success', 'Bạn đã đăng xuất.');
    }
}
