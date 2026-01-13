<?php

namespace App\Http\Controllers;

use App\Models\PmLiberta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\PmLibertaExport;
use App\Imports\PmLibertaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PmLibertaController extends Controller
{
   public function index(Request $request)
    {
        $query = PmLiberta::query();

        $sites = \App\Models\Datasite::all();

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('site_id', 'like', "%$search%")
                ->orWhere('nama_lokasi', 'like', "%$search%")
                ->orWhere('provinsi', 'like', "%$search%")
                ->orWhere('kabupaten_kota', 'like', "%$search%")
                ->orWhere('pic_ce', 'like', "%$search%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', strtoupper(trim($request->status)));
        }

        // Ambil data terfilter
        $data = $query->orderBy('updated_at', 'desc')->get();

        // Hitung nilai
        $totalData = $data->count();
        $doneCount = $data->where('status', 'DONE')->count();
        $donePercentage = $totalData > 0 ? round(($doneCount / $totalData) * 100, 2) : 0;
        
        // Hitung total per kategori
        $kategoriCount = $data->groupBy('kategori')->map(function ($items) {
            return $items->count();
        });

        return view('pmliberta', compact(
            'query',
            'data',
            'doneCount',
            'totalData',
            'donePercentage',
            'kategoriCount'
            ,'sites'
        ));
    }
    public function create()
    {
        $data = PmLiberta::all(); // Atau sesuai kebutuhan
        $totalData = $data->count();
        $doneCount = $data->where('status', 'DONE')->count();
        $donePercentage = $totalData > 0 ? round(($doneCount / $totalData) * 100, 2) : 0;

        return view('pmliberta', compact(
            'data',
            'doneCount',
            'totalData',
            'donePercentage'
        ));
    }
    public function store(Request $request)
    {
        PmLiberta::create($request->all());
        return redirect()->route('pmliberta')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $data = PmLiberta::findOrFail($id);
        return view('pmliberta.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PmLiberta::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('pmliberta')->with('success', 'Data berhasil diupdate');
    }
    public function destroy($id)
    {
        $data = PmLiberta::findOrFail($id);
        $data->delete();
        return redirect()->route('pmliberta')->with('success', 'Data berhasil dihapus');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PmLibertaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }

    public function export()
    {
        return Excel::download(new PmLibertaExport, 'pm_liberta.xlsx');
    }
  
  public function summary(Request $request)
    {
        $bulanDipilih = $request->input('filter_bulan');
        $statusDipilih = strtoupper($request->input('filter_status', 'DONE'));
        $kategoriDipilih = $request->input('filter_kategori');
    
        // Dropdown bulan & status & kategori
        $listBulan = DB::table('pm_liberta')
            ->select('month')
            ->distinct()
            ->orderBy('month', 'asc')
            ->pluck('month');
    
        $listStatus = ['DONE', 'PENDING'];
        $listKategori = ['BMN', 'SL'];
    
        // === Summary per Bulan ===
        $query = DB::table('pm_liberta')
            ->select('kategori', 'month',
                DB::raw("SUM(CASE WHEN status = '$statusDipilih' THEN 1 ELSE 0 END) as done")
            );
    
        if ($bulanDipilih) {
            $query->where('month', '=', $bulanDipilih);
        }
    
        if ($kategoriDipilih) {
            $query->where('kategori', '=', $kategoriDipilih);
        }
    
        $query->groupBy('kategori', 'month');
        $summaryMonth = $query->get();
    
        // === Summary Provinsi (tetap) ===
        $summaryProvinsi = DB::table('pm_liberta')
            ->select('kategori', 'provinsi',
                DB::raw("SUM(CASE WHEN status = 'DONE' THEN 1 ELSE 0 END) as done"),
                DB::raw("SUM(CASE WHEN status = 'PENDING' THEN 1 ELSE 0 END) as pending"),
                DB::raw("COUNT(*) as total"),
                DB::raw("ROUND(SUM(CASE WHEN status = 'DONE' THEN 1 ELSE 0 END)*100.0 / COUNT(*), 2) as persen_done")
            )
            ->groupBy('kategori', 'provinsi')
            ->get();
    
        // === Grafik DONE per tanggal ===
        $chartDonePerDate = DB::table('pm_liberta')
            ->select(
                DB::raw('DATE(date) as label'),
                DB::raw('COUNT(*) as total_done')
            )
            ->where('status', $statusDipilih)
            ->when($bulanDipilih, function ($query) use ($bulanDipilih) {
                $bulanAngka = (int) explode('.', $bulanDipilih)[0];
                $query->whereMonth('date', '=', $bulanAngka)
                    ->whereYear('date', '=', 2025);
            })
            ->when($kategoriDipilih, function ($query) use ($kategoriDipilih) {
                return $query->where('kategori', $kategoriDipilih);
            })
            ->whereNotNull('date')
            ->groupBy('label')
            ->orderBy('label', 'asc')
            ->get();
        
        $filteredData = DB::table('pm_liberta')
            ->when($bulanDipilih, function ($query) use ($bulanDipilih) {
                $query->where('month', $bulanDipilih);
            })
            ->when($statusDipilih, function ($query) use ($statusDipilih) {
                $query->where('status', $statusDipilih);
            })
            ->when($kategoriDipilih, function ($query) use ($kategoriDipilih) {
                $query->where('kategori', $kategoriDipilih);
            })
            ->orderBy('date', 'asc')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('site_id', 'like', "%{$search}%")
                      ->orWhere('nama_lokasi', 'like', "%{$search}%")
                      ->orWhere('provinsi', 'like', "%{$search}%")
                      ->orWhere('kabupaten_kota', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // tampilkan 10 data per halaman
    
        return view('summary', compact(
            'summaryProvinsi',
            'summaryMonth',
            'listBulan',
            'bulanDipilih',
            'chartDonePerDate',
            'listStatus',
            'statusDipilih',
            'listKategori',
            'kategoriDipilih',
            'filteredData'
        ));
    }
    
    public function ajaxSearch(Request $request)
{
    $keyword = $request->search;
    $bulanDipilih = $request->input('filter_bulan');
    $statusDipilih = strtoupper($request->input('filter_status', 'DONE'));
    $kategoriDipilih = $request->input('filter_kategori');

    $filteredData = DB::table('pm_liberta')
        ->when($bulanDipilih, function ($query) use ($bulanDipilih) {
            $query->where('month', $bulanDipilih);
        })
        ->when($statusDipilih, function ($query) use ($statusDipilih) {
            $query->where('status', $statusDipilih);
        })
        ->when($kategoriDipilih, function ($query) use ($kategoriDipilih) {
            $query->where('kategori', $kategoriDipilih);
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('site_id', 'like', "%{$keyword}%")
                    ->orWhere('nama_lokasi', 'like', "%{$keyword}%")
                    ->orWhere('kabupaten_kota', 'like', "%{$keyword}%")
                    ->orWhere('provinsi', 'like', "%{$keyword}%");
            });
        })
        ->orderBy('date', 'desc')
        ->paginate(10)
        ->withQueryString();

    $html = view('summary_table_ajax', compact('filteredData'))->render();
    return response()->json(['html' => $html]);
}
    public function getDataSite($id)
    {
        $site = \App\Models\Datasite::where('id', $id)->first();

        if (!$site) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Tentukan kategori otomatis
        $kategori = '';
        if (strtolower($site->kategori) === 'sewa layanan') {
            $kategori = 'SL';
        } elseif (strtolower($site->kategori) === 'barang milik negara') {
            $kategori = 'BMN';
        }

        return response()->json([
            'site_id' => $site->site_id,
            'provinsi' => $site->provinsi,
            'kab' => $site->kab,
            'kategori' => $kategori,
            'tipe' => $site->tipe,
        ]);
    }
}
   

