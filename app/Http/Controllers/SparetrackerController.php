<?php

namespace App\Http\Controllers;

use App\Models\Sparetracker; // Pastikan Sparetracker model di-import
use Illuminate\Http\Request;
use DB;

class SparetrackerController extends Controller
{
    // Method untuk menampilkan data summary sparepart
    public function summary()
    {
        // Data stock perangkat per jenis per lokasi
        $stock = DB::table('sparetracker')
            ->select('jenis', 'lokasi_realtime', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis', 'lokasi_realtime')
            ->get();
    
        // Data kondisi per jenis
        $kondisiData = DB::table('sparetracker')
            ->select('jenis', 'kondisi', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis', 'kondisi')
            ->get();
    
        // Ambil semua lokasi realtime yang ada
        $lokasiList = DB::table('sparetracker')
            ->select('lokasi_realtime')
            ->distinct()
            ->pluck('lokasi_realtime');
    
        // Ambil semua jenis
        $jenisList = DB::table('sparetracker')
            ->select('jenis')
            ->distinct()
            ->pluck('jenis');
    
        // Ambil semua kondisi
        $kondisiList = DB::table('sparetracker')
            ->select('kondisi')
            ->distinct()
            ->pluck('kondisi');
    
        return view('summaryspare', compact(
            'stock', 'kondisiData', 'lokasiList', 'jenisList', 'kondisiList'
        ));
    }

    public function index()
    {
        $data = Sparetracker::latest()->paginate(20);
        return view('summaryspare', compact('data'));
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
