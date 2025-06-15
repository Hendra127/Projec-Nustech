<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UpdateLastSeen
{
    public function handle($request, Closure $next)
    {
        Log::info('Middleware dijalankan');

        if (Auth::check()) {
            Log::info('User login: ' . Auth::user()->email);
            
            $user = Auth::user();
            $user->last_seen = Carbon::now();
            $user->save();
        } else {
            Log::info('User belum login');
        }

        return $next($request);
    }
}