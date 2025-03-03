<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginRegisterController extends Controller
{
    public function showForm()
    {
        return view('client.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'min:6'],
        ], [
            'login.required'    => 'Vui lòng nhập email hoặc số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        $login    = $request->input('login');
        $password = $request->input('password');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (preg_match('/^[0-9]{10,11}$/', $login)) {
            $fieldType = 'phone';
        } else {
            return back()->withErrors(['login' => 'Vui lòng nhập email hoặc số điện thoại hợp lệ.'])->with('auth_type', 'login');
        }

        $user = User::where($fieldType, $login)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['login' => 'Thông tin đăng nhập không đúng.'])->with('auth_type', 'login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'login'    => ['required', 'string'],
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'name.required'         => 'Vui lòng nhập họ và tên.',
            'login.required'        => 'Vui lòng nhập email hoặc số điện thoại.',
            'password.required'     => 'Vui lòng nhập mật khẩu.',
            'password.min'          => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'    => 'Xác nhận mật khẩu không khớp.',
        ]);

        $login = $request->input('login');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (preg_match('/^[0-9]{10,11}$/', $login)) {
            $fieldType = 'phone';
        } else {
            return back()->withErrors(['login' => 'Vui lòng nhập email hoặc số điện thoại hợp lệ.'])->with('auth_type', 'register');
        }

        if (User::where($fieldType, $login)->exists()) {
            return back()->withErrors(['login' => ucfirst($fieldType) . ' đã được sử dụng.'])->with('auth_type', 'register');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $fieldType === 'email' ? $login : null,
            'phone'    => $fieldType === 'phone' ? $login : null,
            'password' => Hash::make($request->password),
        ]);

        // Auth::login($user);

        return redirect()->route('login.show')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập. ');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home')->with('success', 'Bạn đã đăng xuất.');
    }
}
