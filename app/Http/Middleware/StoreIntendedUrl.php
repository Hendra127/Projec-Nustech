<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StoreIntendedUrl
{
    public function handle($request, Closure $next)
    {
        // Simpan URL hanya jika belum login & bukan halaman login/register/session
        if (
            !Auth::check() &&
            !$request->is('login') &&
            !$request->is('register') &&
            !$request->is('session') &&
            !$request->is('forgot-password') &&
            $request->method() === 'GET'
        ) {
            session(['redirect_to' => $request->path()]);
        }

        return $next($request);
    }
}
