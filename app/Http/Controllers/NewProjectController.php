<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewProjectController extends Controller
{
    public function index()
    {
        return view('newproject');
    }
}
