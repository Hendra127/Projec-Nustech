<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasite;
use App\Models\Tiket;
use App\Models\Site; // Jika kamu pakai model Site
use App\Exports\TiketExport;
use App\Imports\TiketImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataSiteByTiketStatusExport;

class TiketController extends Controller
{
    // Tampilkan semua data tiket dan site
    public function index(Request $request)
{
    try {
        $query = $request->input('query');
        $kategori = $request->input('kategori');
        $sort = $request->input('sort', 'desc');

        $tiket = Tiket::select('*')
            ->selectRaw("durasi + DATEDIFF(CURDATE(), tanggal_rekap) AS durasi_terbaru")
            ->when($query, function ($q) use ($query) {
                    $q->where(function ($subQuery) use ($query) {
                        $subQuery->where('site_id', 'like', '%' . $query . '%')
                                ->orWhere('nama_site', 'like', '%' . $query . '%')
                                ->orWhere('kabupaten', 'like', '%' . $query . '%')
                                ->orWhere('provinsi', 'like', '%' . $query . '%');
                    });
                })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })  
            ->where('status_tiket', 'OPEN')
            ->orderBy('durasi_terbaru', $sort)
            ->paginate(10) // <- pastikan paginate
            ->withQueryString(); // agar search tetap saat pindah halaman

        $semuaSite = Datasite::all(); // gunakan model Site bila tersedia
        $sites = Datasite::select('id', 'sitename')->orderBy('sitename')->get();

        return view('tiket', compact('tiket', 'semuaSite', 'sites'));
    } catch (\Throwable $th) {
        dd($th);
    }
}

    public function closeTiket(Request $request)
    {
        $query = $request->input('search');

        $tiket = Tiket::when($query, function ($q) use ($query) {
            $q->where(function ($subQuery) use ($query) {
                $subQuery->where('nama_site', 'like', '%' . $query . '%')
                         ->orWhere('provinsi', 'like', '%' . $query . '%');
            });
        })->where('status_tiket', 'CLOSE')
          ->paginate(10);


        // Jika kamu punya model Site sendiri:
        // $semuaSite = Site::all();

        // Jika data site ada di tabel yang sama dengan Tiket:
        $semuaSite = Tiket::all();

        return view('close_tiket', compact('tiket', 'semuaSite'));
    }

    // Simpan data tiket baru
    public function store(Request $request)
    {
        try {
            // dd($request->all());
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
                'evidence' => 'nullable',
                'detail_problem' => 'nullable',
                'plan_actions' => 'nullable',
                'ce' => 'nullable|string',
            ]);

            // Cek apakah data dengan kombinasi nama_site, provinsi, kabupaten dan status OPEN sudah ada
            $existing = Tiket::where('nama_site', $request->nama_site)
                        ->where('provinsi', $request->provinsi)
                        ->where('kabupaten', $request->kabupaten)
                        ->where('tanggal_rekap', $request->tanggal_rekap)
                        ->where('status_tiket', 'OPEN')
                        ->first();
            
            if ($existing) {
                return redirect()->route('tiket')->with('error', 'Data tiket dengan kombinasi Nama Site, Site ID, Provinsi, Kabupeten, Tanggal Rekap dan status OPEN yang anda masukkan sudah ada.');
            }
            if ($request->hasFile('evidence')) {
                $file = $request->file('evidence');
                $nama_file = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('evidence', $nama_file, 'public');
                $data['evidence'] = $path;
            }

            Tiket::create($request->all());

            return redirect()->route('tiket')->with('success', 'Data tiket berhasil disimpan.');
        } catch (\Throwable $th) {
            // dd($th);
            // throw $th;
            return redirect()->route('tiket')->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
        
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
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,mp4,avi,mkv|max:10240', // max 10MB
            'detail_problem' => 'nullable',
            'plan_actions' => 'nullable',
            'ce' => 'nullable|string',
            
        ]);

        $tiket = Tiket::findOrFail($id);
            // Handle evidence jika diupload
            if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidences', 'public');
            $tiket->evidence = $path;
        }
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
        $tiket = Tiket::findOrFail($id);

        $tiket->status_tiket = strtoupper($request->status_tiket);

        if ($tiket->status_tiket === 'CLOSE') {
            $tiket->tanggal_close = now(); // otomatis isi tanggal hari ini
            $tiket->bulan_close = now()->format('F'); // otomatis isi nama bulan

            // Perhitungan durasi_akhir tanpa tambahan hari akibat jam
            if ($tiket->tanggal_rekap) {
                $tanggal_rekap = \Carbon\Carbon::parse($tiket->tanggal_rekap)->startOfDay();
                $tanggal_close = \Carbon\Carbon::today();
                $tiket->durasi_akhir = $tanggal_rekap->diffInDays($tanggal_close);
            }
        }

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


    // Hapus data tiket
    public function delete($id)
    {
        try {
            $tiket = Tiket::findOrFail($id);
            $tiket->delete();

            return redirect()->back()->with('success', 'Data tiket berhasil dihapus.');
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data tiket.');
        }
    }
    public function formClose($id)
{
    $tiket = Tiket::findOrFail($id);

    $tanggalClose = date('Y-m-d');
    $bulanClose = date('m');

    return view('close_tiket', compact('tiket', 'tanggalClose', 'bulanClose'));
}

    public function close(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tiket,id',
            'tanggal_close' => 'required|date',
            'bulan_close' => 'required'
        ]);

        $tiket = Tiket::find($request->id);
        $tiket->tanggal_close = $request->tanggal_close;
        $tiket->bulan_close = $request->bulan_close;
        $tiket->status = 'Closed';
        $tiket->save();

        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil di-close.');
    }
    public function otomatisClose(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tiket,id'
        ]);

        $tiket = Tiket::find($request->id);
        $tiket->tanggal_close = date('Y-m-d');
        $tiket->bulan_close = date('m');
        $tiket->status = 'Closed';
        $tiket->save();

        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil di-close.');
    }
    public function getDatasite($id)
{
    $site = Datasite::find($id);

    if (!$site) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    return response()->json($site);
}
public function downloadDataSiteByTiketStatus($status_tiket)
{
    $status_tiket = strtolower($status_tiket);
    if (!in_array($status_tiket, ['open', 'close'])) {
        abort(404);
    }

    return Excel::download(new DataSiteByTiketStatusExport($status_tiket), "tiket_{$status_tiket}_" . date('Ymd_His') . ".xlsx");
}
}
