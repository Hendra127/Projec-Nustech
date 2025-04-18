<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasite;

class HalamanTest extends Controller
{
    public function index()
    {
        $data = Datasite::all();
        return view('halaman_baru', compact('data')); // ini mengarah ke resources/views/halaman-baru.blade.php
    }


}
