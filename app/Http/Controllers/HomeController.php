<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function home(Request $request)
{
    if (!$request->session()->has('visited')) {
        $request->session()->put('visited', true);
        return redirect('landingpage'); // arahkan ke halaman landing
    }

    //return redirect('dashboard'); // lanjut ke dashboard jika sudah pernah
}
}
