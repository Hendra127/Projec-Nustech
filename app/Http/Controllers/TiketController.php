<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Site; // Jika kamu pakai model Site
use App\Exports\TiketExport;
use App\Imports\TiketImport;
use Maatwebsite\Excel\Facades\Excel;

class TiketController extends Controller
{
    // Tampilkan semua data tiket dan site
    public function index(Request $request)
    {
        $query = $request->input('search');

        $tiket = Tiket::when($query, function ($q) use ($query) {
            $q->where('nama_site', 'like', '%' . $query . '%')
              ->orWhere('provinsi', 'like', '%' . $query . '%');
        })->paginate(10);

        // Jika kamu punya model Site sendiri:
        // $semuaSite = Site::all();

        // Jika data site ada di tabel yang sama dengan Tiket:
        $semuaSite = Tiket::all();

        return view('tiket', compact('tiket', 'semuaSite'));
    }

    // Simpan data tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_site' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'durasi' => 'nullable',
            'kategori' => 'nullable',
            'tanggal_rekap' => 'nullable|date',
            'bulan_open' => 'nullable',
            'status_tiket' => 'nullable',
            'kendala' => 'nullable',
            'tanggal_close' => 'nullable|date',
            'bulan_close' => 'nullable',
            'detail_problem' => 'nullable',
        ]);

        Tiket::create($request->all());

        return redirect()->route('tiket')->with('success', 'Data tiket berhasil disimpan.');
    }

    // Update data tiket dari modal
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_site' => 'required',
            'provinsi' => 'nullable',
            'kabupaten' => 'nullable',
            'durasi' => 'nullable',
            'kategori' => 'nullable',
            'tanggal_rekap' => 'nullable|date',
            'bulan_open' => 'nullable',
            'status_tiket' => 'nullable',
            'kendala' => 'nullable',
            'tanggal_close' => 'nullable|date',
            'bulan_close' => 'nullable',
            'detail_problem' => 'nullable',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->update($request->all());

        return redirect()->route('tiket')->with('success', 'Data tiket berhasil diperbarui.');
    }

    // Export data tiket ke Excel
    public function tiketexport()
    {
        return Excel::download(new TiketExport, 'Info-Tiket.xlsx');
    }

    // Import data tiket dari Excel
    public function tiketimport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new TiketImport, $request->file('file'));

        return redirect()->route('tiket')->with('success', 'Data tiket berhasil diimpor.');
    }

    // Update status tiket (OPEN/CLOSE)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_tiket' => 'required|in:OPEN,CLOSE'
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->status_tiket = $request->status_tiket;
        $tiket->save();

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function getDataSites(Request $request)
    {
        try {
            $term = $request->input('term');

            $sites = Tiket::select('id', 'nama_site')
                ->when($term, function ($query) use ($term) {
                    $query->where('nama_site', 'LIKE', "%{$term}%");
                })
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sites
            ]);
        } catch (\Throwable $th) {
            // Log error biar ketahuan kalau ada masalah
            \Log::error($th);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sites.'
            ], 500);
        }
    }

    public function getDataSiteById($id)
    {
        try {
            $site = Tiket::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $site
            ]);
        } catch (\Throwable $th) {
            \Log::error($th);

            return response()->json([
                'success' => false,
                'message' => 'Data site tidak ditemukan.'
            ], 404);
        }
    }
}
