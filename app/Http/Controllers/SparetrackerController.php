<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SparetrackerController extends Controller
{
     public function index()
    {
        $data = Sparetracker::latest()->paginate(20);
        return view('sparetracker.index', compact('data'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new \App\Imports\SparetrackerImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor.');
    }
}
