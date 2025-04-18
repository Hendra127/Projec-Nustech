<?php

namespace App\Http\Controllers;

use App\Models\Datasite;
use App\Exports\DataExport;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    /**
     * Menampilkan data site.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $site = Datasite::where(function ($q) use ($query) {
                $q->where('site_id', 'LIKE', "%{$query}%")
                  ->orWhere('sitename', 'LIKE', "%{$query}%")
                  ->orWhere('tipe', 'LIKE', "%{$query}%")
                  ->orWhere('batch', 'LIKE', "%{$query}%")
                  ->orWhere('latitude', 'LIKE', "%{$query}%")
                  ->orWhere('longitude', 'LIKE', "%{$query}%")
                  ->orWhere('provinsi', 'LIKE', "%{$query}%")
                  ->orWhere('kab', 'LIKE', "%{$query}%")
                  ->orWhere('kecamatan', 'LIKE', "%{$query}%")
                  ->orWhere('kelurahan', 'LIKE', "%{$query}%")
                  ->orWhere('alamat_lokasi', 'LIKE', "%{$query}%")
                  ->orWhere('nama_pic', 'LIKE', "%{$query}%")
                  ->orWhere('nomor_pic', 'LIKE', "%{$query}%")
                  ->orWhere('sumber_listrik', 'LIKE', "%{$query}%")
                  ->orWhere('gateway_area', 'LIKE', "%{$query}%")
                  ->orWhere('beam', 'LIKE', "%{$query}%")
                  ->orWhere('hub', 'LIKE', "%{$query}%")
                  ->orWhere('kodefikasi', 'LIKE', "%{$query}%")
                  ->orWhere('sn_antena', 'LIKE', "%{$query}%")
                  ->orWhere('sn_modem', 'LIKE', "%{$query}%")
                  ->orWhere('sn_router', 'LIKE', "%{$query}%")
                  ->orWhere('sn_ap1', 'LIKE', "%{$query}%")
                  ->orWhere('sn_ap2', 'LIKE', "%{$query}%")
                  ->orWhere('sn_tranciever', 'LIKE', "%{$query}%")
                  ->orWhere('sn_stabilizer', 'LIKE', "%{$query}%")
                  ->orWhere('sn_rak', 'LIKE', "%{$query}%")
                  ->orWhere('ip_modem', 'LIKE', "%{$query}%")
                  ->orWhere('ip_router', 'LIKE', "%{$query}%")
                  ->orWhere('ip_ap1', 'LIKE', "%{$query}%")
                  ->orWhere('ip_ap2', 'LIKE', "%{$query}%")
                  ->orWhere('expected_sqf', 'LIKE', "%{$query}%");
            })->paginate(50);
        } else {
            $site = Datasite::paginate(50);
        }

        return view('tables', compact('site'));
    }

    /**
     * Method pencarian (opsional jika ingin pisah route /search).
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $site = Datasite::where(function ($q) use ($query) {
            $q->where('site_id', 'LIKE', "%{$query}%")
              ->orWhere('sitename', 'LIKE', "%{$query}%")
              ->orWhere('tipe', 'LIKE', "%{$query}%")
              ->orWhere('batch', 'LIKE', "%{$query}%")
              ->orWhere('latitude', 'LIKE', "%{$query}%")
              ->orWhere('longitude', 'LIKE', "%{$query}%")
              ->orWhere('provinsi', 'LIKE', "%{$query}%")
              ->orWhere('kab', 'LIKE', "%{$query}%")
              ->orWhere('kecamatan', 'LIKE', "%{$query}%")
              ->orWhere('kelurahan', 'LIKE', "%{$query}%")
              ->orWhere('alamat_lokasi', 'LIKE', "%{$query}%")
              ->orWhere('nama_pic', 'LIKE', "%{$query}%")
              ->orWhere('nomor_pic', 'LIKE', "%{$query}%")
              ->orWhere('sumber_listrik', 'LIKE', "%{$query}%")
              ->orWhere('gateway_area', 'LIKE', "%{$query}%")
              ->orWhere('beam', 'LIKE', "%{$query}%")
              ->orWhere('hub', 'LIKE', "%{$query}%")
              ->orWhere('kodefikasi', 'LIKE', "%{$query}%")
              ->orWhere('sn_antena', 'LIKE', "%{$query}%")
              ->orWhere('sn_modem', 'LIKE', "%{$query}%")
              ->orWhere('sn_router', 'LIKE', "%{$query}%")
              ->orWhere('sn_ap1', 'LIKE', "%{$query}%")
              ->orWhere('sn_ap2', 'LIKE', "%{$query}%")
              ->orWhere('sn_tranciever', 'LIKE', "%{$query}%")
              ->orWhere('sn_stabilizer', 'LIKE', "%{$query}%")
              ->orWhere('sn_rak', 'LIKE', "%{$query}%")
              ->orWhere('ip_modem', 'LIKE', "%{$query}%")
              ->orWhere('ip_router', 'LIKE', "%{$query}%")
              ->orWhere('ip_ap1', 'LIKE', "%{$query}%")
              ->orWhere('ip_ap2', 'LIKE', "%{$query}%")
              ->orWhere('expected_sqf', 'LIKE', "%{$query}%");
        })->paginate(50);

        return view('tables', compact('site'));
    }

    /**
     * Mengekspor data site ke file Excel.
     */
    public function dataexport()
    {
        return Excel::download(new DataExport, 'Data-site.xlsx');
    }

    /**
     * Mengimpor data site dari file Excel/CSV.
     */
    public function dataimport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('datasite', $namaFile);

        Excel::import(new DataImport, public_path('/datasite/' . $namaFile));

        return redirect()->route('tables')->with('success', 'Data berhasil diimpor.');
    }

    /**
     * Menampilkan form untuk menambah data site.
     */
    public function create()
    {
        return view('datacreate');
    }

    /**
     * Menyimpan data site yang baru.
     */
    public function store(Request $request)
    {
        // Memastikan site_id diisi (menggunakan UUID sebagai contoh)
        $request->merge([
            'site_id' => Str::uuid(), // Menggunakan UUID untuk site_id
        ]);

        // Menyimpan data site baru
        Datasite::create($request->all());

        return redirect()->route('tables')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
