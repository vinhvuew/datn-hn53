<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Mail\ForgotPasswordMail;
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
            'login.required'    => 'Vui lòng nhập email',
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

        if (!$user) {
            return back()->withErrors(['login' => ucfirst($fieldType) . ' không tồn tại.'])->with('auth_type', 'login');
        }

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['password' => 'Mật khẩu không đúng.'])->with('auth_type', 'login');
        }


        // Nếu email chưa được xác thực, chuyển hướng sang trang nhập mã xác thực
        if ($user->email && !$user->email_verified_at) {
            session(['email_verification' => $user->email]); // Lưu email vào session
            return redirect()->route('verification.form')->with('message', 'Tài khoản chưa được xác thực. Vui lòng nhập mã xác thực.');
        }

        Auth::login($user);
        return redirect('/')->with('success', 'Đăng nhập thành công!');
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

        $verificationCode = mt_rand(100000, 999999);

        $user = User::create([
            'role_id'  => 2,
            'name'     => $request->name,
            'email'    => $fieldType === 'email' ? $login : null,
            'phone'    => $fieldType === 'phone' ? $login : null,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

        if ($user->email) {
            Mail::to($user->email)->send(new VerifyEmail($user));
        }

        return redirect()->route('login.show')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
    }

    public function showVerificationForm()
    {
        if (!session()->has('email_verification')) {
            return redirect()->route('login.show')->withErrors(['error' => 'Không tìm thấy email cần xác thực.']);
        }

        return view('client.auth.verify_code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Vui lòng nhập mã xác thực.',
            'code.digits' => 'Mã xác thực phải có 6 chữ số.',
        ]);

        $email = session('email_verification');

        $user = User::where('email', $email)
            ->where('verification_code', $request->code)
            ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Mã xác thực không đúng.']);
        }

        // Kiểm tra thời gian mã hết hạn
        if ($user->verification_code_expires_at && now()->greaterThan($user->verification_code_expires_at)) {
            return back()->withErrors(['code' => 'Mã xác thực đã hết hạn. Vui lòng yêu cầu gửi lại mã.']);
        }

        // Cập nhật trạng thái xác thực email
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        // Đăng nhập người dùng
        Auth::login($user);

        // Xóa session xác thực
        session()->forget('email_verification');

        return redirect('/')->with('success', 'Tài khoản đã được xác thực thành công!');
    }

    public function resendVerification()
    {
        $email = session('email_verification');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login.show')->withErrors(['login' => 'Không tìm thấy tài khoản với email này.']);
        }

        if ($user->email_verified_at) {
            return redirect()->route('login.show')->with('success', 'Email đã được xác thực trước đó. Bạn có thể đăng nhập.');
        }

        // Kiểm tra thời gian gửi mã gần nhất
        if ($user->verification_code_sent_at && now()->diffInSeconds($user->verification_code_sent_at) < 60) {
            $remainingTime = 60 - now()->diffInSeconds($user->verification_code_sent_at);
            return back()->with(['error' => "Vui lòng đợi {$remainingTime} giây trước khi gửi lại mã.", 'remaining_time' => $remainingTime]);
        }

        $verificationCode = mt_rand(100000, 999999);
        $user->verification_code = $verificationCode;
        $user->verification_code_sent_at = now();
        $user->verification_code_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new VerifyEmail($user));

        return redirect()->route('verification.form')->with('message', 'Mã xác thực mới đã được gửi. Vui lòng kiểm tra email.');
    }


    public function showForgotPasswordForm()
    {
        $user = null;
        return view('client.auth.forgot_password', compact('user'));
    }

    // Xử lý yêu cầu quên mật khẩu
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này chưa được đăng ký.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Kiểm tra nếu đã gửi mã gần đây (thời gian chờ 60 giây)
        if ($user->password_reset_sent_at && now()->diffInSeconds($user->password_reset_sent_at) < 60) {
            $remaining = 60 - now()->diffInSeconds($user->password_reset_sent_at);
            return back()->withErrors(['email' => "Vui lòng chờ {$remaining} giây trước khi yêu cầu lại."]);
        }

        // Tạo mã OTP 6 số
        $otp = mt_rand(100000, 999999);
        $user->verification_code = $otp;
        $user->password_reset_sent_at = now();
        $user->password_reset_expires_at = now()->addMinutes(5); // Hết hạn sau 5 phút
        $user->save();

        // Gửi mã OTP qua email
        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        // Lưu email vào session
        session(['password_reset_email' => $user->email]);

        return redirect()->route('password.verify.form')->with('message', 'Mã xác thực đã được gửi. Vui lòng kiểm tra email.');
    }

    // Hiển thị form nhập mã OTP
    public function showVerifyResetCodeForm()
    {
        if (!session()->has('password_reset_email')) {
            return redirect()->route('password.forgot.form')->withErrors(['error' => 'Vui lòng nhập email để nhận mã xác thực.']);
        }

        return view('client.auth.verify_reset_code');
    }

    public function resendVerificationForPassword()
    {
        $email = session('password_reset_email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
        }

        // Kiểm tra thời gian gửi mã gần nhất
        if ($user->password_reset_sent_at && now()->diffInSeconds($user->password_reset_sent_at) < 60) {
            $remainingTime = 60 - now()->diffInSeconds($user->password_reset_sent_at);
            return back()->with(['error' => "Vui lòng đợi {$remainingTime} giây trước khi gửi lại mã.", 'remaining_time' => $remainingTime]);
        }

        // Tạo mã OTP mới
        $resetCode = mt_rand(100000, 999999);
        $user->verification_code = $resetCode;
        $user->password_reset_sent_at = now();
        $user->password_reset_expires_at = now()->addMinutes(5);
        $user->save();

        // Gửi email đặt lại mật khẩu
        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect()->route('password.verify')->with('message', 'Mã xác thực mới đã được gửi. Vui lòng kiểm tra email.');
    }


    // Xác thực mã OTP
    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Vui lòng nhập mã xác thực.',
            'code.digits' => 'Mã xác thực phải có 6 chữ số.',
        ]);

        $email = session('password_reset_email');
        $user = User::where('email', $email)->where('verification_code', $request->code)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Mã xác thực không đúng.']);
        }
        if ($user->password_reset_expires_at && now()->greaterThan($user->password_reset_expires_at)) {
            return back()->withErrors(['code' => 'Mã xác thực đã hết hạn. Vui lòng yêu cầu gửi lại mã.']);
        }

        // Xóa mã xác thực và chuyển sang bước đặt lại mật khẩu
        session(['password_reset_verified' => true]);

        return redirect()->route('password.reset.form');
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm()
    {
        if (!session()->has('password_reset_verified')) {
            return redirect()->route('password.forgot.form')->withErrors(['error' => 'Vui lòng xác thực mã OTP trước.']);
        }

        return view('client.auth.reset_password');
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
        if (!session('password_reset_verified')) {
            return redirect()->route('password.request.form')->withErrors(['error' => 'Bạn chưa xác thực mã OTP.']);
        }

        $email = session('password_reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.forgot.form')->withErrors(['error' => 'Không tìm thấy tài khoản.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->verification_code = null; // Xóa mã OTP
        $user->save();

        // Xóa session
        session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('login.show')->with('success', 'Mật khẩu đã được đặt lại thành công. Vui lòng đăng nhập.');
    }


    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home')->with('success', 'Bạn đã đăng xuất.');
    }

    public function profile()
    {
        $auth = auth('cus')->user();
        return view('user.profile', compact('auth'));
    }
}
