<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->is_admin !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
