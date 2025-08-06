<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPM;
use App\Imports\LaporanPMImport;
use App\Exports\LaporanPMExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class LaporanPMController extends Controller
{
    public function index(Request $request)
    {
        $laporan = LaporanPM::latest()->paginate(10);

        // Cek apakah ada query pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $laporan = LaporanPM::where('site_id', 'like', "%{$search}%")
                ->orWhere('lokasi_site', 'like', "%{$search}%")
                ->orWhere('kabupaten_kota', 'like', "%{$search}%")
                ->orWhere('provinsi', 'like', "%{$search}%")
                ->orWhere('pm_bulan', 'like', "%{$search}%")
                ->orWhere('teknisi', 'like', "%{$search}%")
                ->latest()
                ->paginate(10);
        }

        return view('laporanPM', compact('laporan'));
    }

    public function create()
    {
        return view('laporanpm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_submit' => 'required|date',
            'site_id' => 'required',
            'lokasi_site' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'pm_bulan' => 'required',
            'laporan_ba_pm' => 'nullable|date',
            'teknisi' => 'nullable|string', // ✅ ubah jadi nullable
            'masalah_kendala' => 'nullable|string',
            'action' => 'nullable|string',
            'ket_tambahan' => 'nullable|string',
            'status_laporan' => 'nullable|string',
        ]);

        LaporanPM::create($request->all());
        return redirect()->route('laporanpm.index')->with('success', 'Laporan PM berhasil ditambahkan.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new LaporanPMImport, $request->file('file'));

        return back()->with('success', 'Import berhasil!');
    }

    public function export()
    {
        return Excel::download(new LaporanPMExport, 'laporan_pm.xlsx');
    }
    public function edit($id)
    {
        $laporan = LaporanPM::findOrFail($id);
        return view('laporanpm.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_submit' => 'required|date',
            'site_id' => 'required',
            'lokasi_site' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'pm_bulan' => 'required',
            'laporan_ba_pm' => 'nullable|date',
            'teknisi' => 'nullable|string',
            'masalah_kendala' => 'nullable|string',
            'action' => 'nullable|string',
            'ket_tambahan' => 'nullable|string',
            'status_laporan' => 'nullable|string',
        ]);

        $laporan = LaporanPM::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('laporanPM')->with('success', 'Laporan PM berhasil diupdate.');
    }
    
}
