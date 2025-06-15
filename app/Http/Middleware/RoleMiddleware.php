<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
{
    // Kalau tidak login, lewati saja (anggap publik)
    if (!Auth::check()) {
        return $next($request);
    }

    // Kalau login tapi role cocok, izinkan
    if (in_array(Auth::user()->role, $roles)) {
        return $next($request);
    }

    // Kalau login tapi role tidak cocok, tolak
    abort(403, 'Anda tidak memiliki hak akses.');
}
}
