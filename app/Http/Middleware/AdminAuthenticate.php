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
       
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return redirect()->route('logad')->with('error', 'Bạn cần đăng nhập với quyền admin.');
        }

       
        if (!session()->has('admin_authenticated')) {
            return redirect()->route('logad')->with('error', 'Bạn cần đăng nhập lại.');
        }

        return $next($request);
    }
}
