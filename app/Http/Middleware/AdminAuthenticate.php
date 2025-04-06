<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu chưa đăng nhập hoặc không có quyền admin/moderator
        if (!Auth::check() || !in_array(Auth::user()->role_id, [1, 3, 4])) {
            return redirect()->route('logad')->with('error', 'Bạn cần đăng nhập với quyền admin.');
        }

        // Kiểm tra nếu session xác thực admin không tồn tại
        if (!session()->has('admin_authenticated')) {
            Auth::logout(); // Tự động đăng xuất
            session()->forget('admin_authenticated'); // Xoá session cũ
            return redirect()->route('logad')->with('error', 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
        }

        return $next($request);
    }
}