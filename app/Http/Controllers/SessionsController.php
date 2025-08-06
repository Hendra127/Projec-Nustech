<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create(Request $request)
    {
        if ($request->has('redirect')) {
            session(['redirect_to' => $request->redirect]);
        }

        return view('session.login-session');
    }

    public function store()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            Auth::user()->update(['is_online' => true]);

           return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Email or password invalid.']);
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user) {
            $user->update(['is_online' => false]); // Tandai offline
        }

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with(['success' => "You've been logged out."]);
    }
}
