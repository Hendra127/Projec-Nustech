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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    // Tampilkan semua data tiket dan site
    public function index(Request $request)
    {
        try {
            $query = $request->input('query');
            $kategori = $request->input('kategori');
            $sort = $request->input('sort', 'desc');
            $tanggalClose = $request->input('tanggal_close');
            $tanggalRekap = $request->input('tanggal_rekap');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $filter = $request->query('filter');
            $today = Carbon::today();
            $yesterday = Carbon::yesterday();

            // Hitung total tiket OPEN
            $tiketOpenCount = Tiket::where('status_tiket', 'OPEN')->count();

            // Tiket OPEN hari ini
            $tiketOpenTodayCount = Tiket::where('status_tiket', 'OPEN')
                ->whereDate('tanggal_rekap', $today)
                ->count();

            // Tiket CLOSE (semua / filter tanggal_close)
            $tiketCloseCount = Tiket::where('status_tiket', 'CLOSE')
                ->when($tanggalClose, function ($q) use ($tanggalClose) {
                    $q->whereDate('tanggal_close', $tanggalClose);
                })
                ->count();

            $tiketCloseTodayCount = Tiket::where('status_tiket', 'CLOSE')
                ->whereDate('tanggal_close', $today)
                ->count();

            // Tiket OPEN kemarin
            $tiketOpenYesterdayCount = Tiket::where('status_tiket', 'OPEN')
                ->whereDate('tanggal_rekap', $yesterday)
                ->count();

            // Semua data site
            $semuaSite = Datasite::all();
            $sites = Datasite::select('id', 'sitename')->orderBy('sitename')->get();

            // Statistik per kabupaten
            $kabupatenList = DB::table('datasite')->select('kab')->distinct()->pluck('kab');
            $openSitesByKabupaten = $kabupatenList->map(function ($kab) {
                $total = DB::table('tiket')
                    ->where('kabupaten', $kab)
                    ->where('status_tiket', 'OPEN')
                    ->count();
                return (object)[
                    'kab' => $kab,
                    'total' => $total
                ];
            });

            // Statistik bulanan OPEN + CLOSE
            $data = DB::table('tiket')
                ->select('bulan_open as bulan', DB::raw('count(*) as total_open'), DB::raw('0 as total_close'))
                ->whereNotNull('bulan_open')
                ->groupBy('bulan_open')
                ->unionAll(
                    DB::table('tiket')
                        ->select('bulan_close as bulan', DB::raw('0 as total_open'), DB::raw('count(*) as total_close'))
                        ->whereNotNull('bulan_close')
                        ->where('bulan_close', '!=', 'BELUM CLOSE')
                        ->groupBy('bulan_close')
                )
                ->get();

            $lastTwo = $data->take(-2)->values();

            // DATA UTAMA: TIKET
            $tiket = Tiket::select('*')
                ->selectRaw("durasi + DATEDIFF(CURDATE(), tanggal_rekap) AS durasi_terbaru")
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($sub) use ($query) {
                        $sub->where('site_id', 'like', '%' . $query . '%')
                            ->orWhere('nama_site', 'like', '%' . $query . '%')
                            ->orWhere('kabupaten', 'like', '%' . $query . '%')
                            ->orWhere('provinsi', 'like', '%' . $query . '%');
                    });
                })
                ->when($kategori, function ($q) use ($kategori) {
                    $q->where('kategori', $kategori);
                })
                ->when($tanggalClose, function ($q) use ($tanggalClose) {
                    $q->where('status_tiket', 'CLOSE')
                        ->whereDate('tanggal_close', $tanggalClose);
                }, function ($q) use ($filter, $yesterday, $today) {
                    $q->where('status_tiket', 'OPEN');

                    if ($filter === 'open_yesterday') {
                        $q->whereDate('tanggal_rekap', $yesterday);
                    } elseif ($filter === 'open_today') {
                        $q->whereDate('tanggal_rekap', $today);
                    }
                })
                ->when($tanggalRekap, function ($q) use ($tanggalRekap) {
                    $q->whereDate('tanggal_rekap', $tanggalRekap);
                })
                ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('tanggal_rekap', [$startDate, $endDate]);
                })
                ->orderBy('durasi_terbaru', $sort)
                ->paginate(10)
                ->withQueryString();

            // Tambahan data tiket OPEN (untuk bagian lain)
            $tiketOpenQuery = Tiket::where('status_tiket', 'OPEN');

            if ($filter === 'open_yesterday') {
                $tiketOpenQuery->whereDate('tanggal_rekap', $yesterday);
            } elseif ($filter === 'open_today') {
                $tiketOpenQuery->whereDate('tanggal_rekap', $today);
            }

            $tiketOpen = $tiketOpenQuery->get();

            return view('tiket', compact(
                'tiket',
                'semuaSite',
                'sites',
                'tiketOpenCount',
                'tiketCloseCount',
                'tiketCloseTodayCount',
                'tiketOpenYesterdayCount',
                'openSitesByKabupaten',
                'data',
                'lastTwo',
                'kategori',
                'sort',
                'query',
                'tiketOpen',
                'tanggalClose',
                'tanggalRekap',
                'startDate',
                'endDate',
                'tiketOpenTodayCount'
            ));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function detailTiket($id)
    {
        $kabupatenList = DB::table('datasite')->select('kab')->distinct()->pluck('kab');

        $openSitesByKabupaten = $kabupatenList->map(function ($kab) {
            $total = DB::table('tiket')
                ->where('kabupaten', $kab)
                ->where('status_tiket', 'OPEN')
                ->count();

            return (object)[
                'kab' => $kab,
                'total' => $total
            ];
        });
        $allTiket = Tiket::where('status_tiket', 'OPEN')
                ->orderBy('created_at')
                ->get();

        $tiket = Tiket::find($id);
        $semuaSite = Datasite::all(); // gunakan model Site bila tersedia
        return view('tiket_close', compact('tiket', 'semuaSite', 'openSitesByKabupaten', 'allTiket'));
    }


    public function closeTiket(Request $request)
    {
        $search = $request->input('search');
        $tanggal = $request->input('tanggal_close');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tiket = Tiket::query()
            ->where('status_tiket', 'CLOSE')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('site_id', 'like', '%' . $search . '%')
                    ->orWhere('nama_site', 'like', '%' . $search . '%')
                    ->orWhere('kabupaten', 'like', '%' . $search . '%')
                    ->orWhere('provinsi', 'like', '%' . $search . '%');
                });
            })
            ->when($tanggal, function ($query) use ($tanggal) {
                $query->whereDate('tanggal_close', $tanggal);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_close', [$startDate, $endDate]);
            })
            ->orderBy('tanggal_close', 'desc')
            ->paginate(10);

        // Hitung jumlah tiket close dalam rentang tanggal (jika ada)
        $jumlahDalamRentang = null;
        if ($startDate && $endDate) {
            $jumlahDalamRentang = Tiket::where('status_tiket', 'CLOSE')
                ->whereBetween('tanggal_close', [$startDate, $endDate])
                ->count();
        }

        $tiketCloseCount = Tiket::where('status_tiket', 'CLOSE')->count();
        $tiketOpenCount = Tiket::where('status_tiket', 'OPEN')->count();

        $tiketCloseTodayCount = Tiket::where('status_tiket', 'CLOSE')
            ->whereDate('tanggal_close', Carbon::today())
            ->count();

        $semuaSite = Tiket::all();

        $errorMessage = null;
        if ($tanggal && $tiket->total() == 0) {
            $errorMessage = 'Data tiket dengan tanggal yang dipilih (' . $tanggal . ') tidak ada.';
        }

        return view('close_tiket', compact(
            'tiket',
            'semuaSite',
            'tiketCloseCount',
            'tiketOpenCount',
            'tiketCloseTodayCount',
            'search',
            'tanggal',
            'errorMessage',
            'jumlahDalamRentang',
            'startDate', 
            'endDate'
        ));
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
        // Batasi akses hanya untuk user atau admin
        if (!in_array(auth()->user()->role, ['user', 'admin', 'superadmin'])) {
            abort(403, 'Unauthorized');
        }

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
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,mp4,avi,mkv|max:10240',
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

        $tiket->update($request->except('evidence'));

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

    // Close tiket secara manual
    public function close(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tiket,id',
            'tanggal_close' => 'required|date',
            'bulan_close' => 'required'
        ]);

        $tiket = Tiket::findOrFail($request->id);
        $tiket->tanggal_close = $request->tanggal_close;
        $tiket->bulan_close = $request->bulan_close;
        $tiket->status_tiket = 'CLOSE';
        $tiket->save();

        return redirect()->route('tiket')->with('success', 'Tiket berhasil di-close.');
    }

    // Close tiket otomatis (pakai tanggal hari ini)
    public function otomatisClose(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tiket,id'
        ]);

        $tiket = Tiket::findOrFail($request->id);
        $tiket->tanggal_close = now()->format('Y-m-d');
        $tiket->bulan_close = now()->format('F');
        $tiket->status_tiket = 'CLOSE';
        $tiket->save();

        return redirect()->route('tiket')->with('success', 'Tiket berhasil di-close.');
    }

    // Ambil data site berdasarkan site_id
    public function getDatasite($id)
    {
        $site = Datasite::where('site_id', $id)->first();

        if (!$site) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($site);
    }

    // Download data site berdasarkan status tiket
    public function downloadDataSiteByTiketStatus($status_tiket)
    {
        $status_tiket = strtolower($status_tiket);
        if (!in_array($status_tiket, ['open', 'close'])) {
            abort(404);
        }

        return Excel::download(new DataSiteByTiketStatusExport($status_tiket), "tiket_{$status_tiket}_" . date('Ymd_His') . ".xlsx");
    }

    // List datasite untuk select2/autocomplete
    public function getDatasiteList(Request $request)
    {
        $term = $request->input('term');

        $results = Datasite::select('site_id', 'sitename')
            ->when($term, function ($query) use ($term) {
                return $query->where('sitename', 'like', "%{$term}%");
            })
            ->limit(20)
            ->get();

        return response()->json([
            'results' => $results->map(function ($site) {
                return [
                    'id' => $site->site_id,
                    'text' => $site->sitename
                ];
            }),
        ]);
    }

    // Filter tiket yang sudah close
    public function filter(Request $request)
    {
        $filter = $request->get('filter');
        if ($filter == 'today') {
            $tiket = Tiket::where('status_tiket', 'CLOSE')
                ->whereDate('tanggal_close', now())
                ->orderBy('tanggal_close', 'desc')
                ->paginate(10);
        } else {
            $tiket = Tiket::where('status_tiket', 'CLOSE')
                ->orderBy('tanggal_close', 'desc')
                ->paginate(10);
        }
        // Partial harus ADA!
        return view('partials.table_tiket', compact('tiket'))->render();
    }
    public function updateTanggalClose(Request $request, $id)
    {
        $request->validate([
            'tanggal_close' => 'required|date',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->update([
            'tanggal_close' => $request->tanggal_close,
        ]);

        return redirect()->route('close.tiket')->with('success', 'Tanggal Close berhasil diupdate.');
    }
    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'tanggal_close' => 'required|date',
            'plan_actions' => 'required|string',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->tanggal_close = $request->tanggal_close;
        $tiket->plan_actions = $request->plan_actions;
        $tiket->save();

        return redirect()->route('close.tiket')->with('success', 'Plan Action & Tanggal Close berhasil diperbarui.');
    }
    public function show($id)
{
    $tiket = Tiket::findOrFail($id);

    // Hitung durasi terbaru secara dinamis
    $durasi = $tiket->durasi;
    if ($tiket->status !== 'closed') {
        $tanggalRekap = Carbon::parse($tiket->tanggal_rekap);
        $today = Carbon::today();
        if ($today->gt($tanggalRekap)) {
            $durasi += $tanggalRekap->diffInDays($today); // atau +1 saja jika mau fixed 1 hari
        }
    }

    // Tambahkan ke response
    $tiket->durasi_terbaru = $durasi;

    return response()->json($tiket);
}

}
