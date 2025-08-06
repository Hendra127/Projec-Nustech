<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparetracker;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LogTrackerImport;
use App\Exports\LogTrackerExport;
use App\Models\Datasite;

class LogspareController extends Controller
{
    public function index(Request $request)
{
    $query = Sparetracker::query();

    if ($request->search) {
        $searchTerm = trim($request->search);
        $query->where(function ($q) use ($searchTerm) {
            $q->where('sn', 'like', "%{$searchTerm}%")
              ->orWhere('nama_perangkat', 'like', "%{$searchTerm}%");
        });
    }

    $data = $query->latest()->paginate(20);

    return view('logtracker', compact('data'));
}

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new LogTrackerImport, $request->file('file'));
        return back()->with('success', 'Data berhasil diimpor.');
    }

    public function export()
    {
        return Excel::download(new LogTrackerExport, 'logtracker.xlsx');
    }

    // Menampilkan form tambah data
public function create()
{
    return view('logtracker');
}

// Menyimpan data ke database
public function store(Request $request)
{
    $request->validate([
        'sn' => 'required|string|max:255',
        'jenis' => 'nullable|string|max:255',
        'lokasi_realtime' => 'nullable|string|max:255',
        // Validasi lainnya sesuai kebutuhan
    ]);

    $spare = Sparetracker::create($request->all());

    // Sinkron SN ke datasite jika ada
    $datasite = Datasite::where('sitename', $spare->lokasi_realtime)->first();
    if ($datasite) {
        $jenis = strtoupper(trim($spare->jenis));
        switch ($jenis) {
            case 'MODEM':
                $datasite->sn_modem = $spare->sn;
                break;
            case 'ROUTER':
                $datasite->sn_router = $spare->sn;
                break;
            case 'SWITCH':
                $datasite->sn_switch = $spare->sn;
                break;
            case 'AP1':
            case 'ACCESS POINT 1':
            case 'AP 1':
                $datasite->sn_ap1 = $spare->sn;
                break;
            case 'AP2':
            case 'ACCESS POINT 2':
            case 'AP 2':
                $datasite->sn_ap2 = $spare->sn;
                break;
            case 'STAVOL':
            case 'STABILIZER':
                $datasite->sn_stabilizer = $spare->sn;
                break;
        }
        $datasite->save();
    }

    return redirect()->back()->with('success', 'Data berhasil ditambahkan dan disinkronkan ke datasite');
}

    public function update(Request $request)
    {
        $data = Sparetracker::findOrFail($request->id);

        // Update data sparetracker
        $data->update([
            'sn' => $request->sn,
            'nama_perangkat' => $request->nama_perangkat,
            'jenis' => $request->jenis,
            'type' => $request->type,
            'kondisi' => $request->kondisi,
            'pengadaan_by' => $request->pengadaan_by,
            'lokasi_asal' => $request->lokasi_asal,
            'lokasi' => $request->lokasi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'status_penggunaan_sparepart' => $request->status_penggunaan_sparepart,
            'lokasi_realtime' => $request->lokasi_realtime,
            'kabupaten' => $request->kabupaten,
            'layanan_ai' => $request->layanan_ai,
            'keterangan' => $request->keterangan,
        ]);

        // Sinkron ke tabel datasite
        $datasite = Datasite::where('sitename', $data->lokasi_realtime)->first();

        if ($datasite) {
            $jenis = strtoupper(trim($data->jenis)); // normalisasi teks jenis

            switch ($jenis) {
                case 'MODEM':
                    $datasite->sn_modem = $data->sn;
                    break;
                case 'ROUTER':
                    $datasite->sn_router = $data->sn;
                    break;
                case 'SWITCH':
                    $datasite->sn_switch = $data->sn;
                    break;
                case 'AP1':
                case 'ACCESS POINT 1':
                case 'AP 1':
                    $datasite->sn_ap1 = $data->sn;
                    break;
                case 'AP2':
                case 'ACCESS POINT 2':
                case 'AP 2':
                    $datasite->sn_ap2 = $data->sn;
                    break;
                case 'STAVOL':
                case 'STABILIZER':
                    $datasite->sn_stabilizer = $data->sn;
                    break;
            }

            $datasite->save();
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui dan datasite disinkronkan.');
    }

    public function destroy($id)
    {
        $data = Sparetracker::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

}