<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\PmLiberta;
use App\Models\Site;
use Carbon\Carbon;
use DB;
use App\Models\JadwalPiket;

class MyDashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan_open ?? Carbon::now()->month;

        // Statistik Tiket
        $totalTiket = Tiket::where('status_tiket', 'open')->count();
        $tiketOpen    = Tiket::where('status_tiket', 'open')->count();
        $tiketClosed  = Tiket::where('status_tiket', 'closed')->count();
        $tiketToday   = Tiket::whereDate('created_at', Carbon::today())->count();
        $tiket = Tiket::with('site')->get();

        // Statistik Laporan PM (pakai PmLiberta)
        $totalPm   = PmLiberta::count();
        $pmDone    = PmLiberta::where('status', 'done')->count();
        $pmPending = PmLiberta::where('status', 'pending')->count();

        // Statistik bulanan untuk grafik
        $monthlyTiket = Tiket::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // === Tambahan sesuai gambar dashboard ===

        // Tasks → list tiket open terbaru (nama site + problem)
        $tasks = Tiket::where('status_tiket', 'open')
            ->select('kendala', DB::raw('GROUP_CONCAT(nama_site) as sites'))
            ->groupBy('kendala')
            ->get();

        // Statistik kabupaten → jumlah tiket open per kabupaten
        $statKab = Tiket::where('status_tiket', 'open')
            ->whereNotNull('kabupaten')
            ->select('kabupaten', DB::raw('COUNT(*) as total'))
            ->groupBy('kabupaten')
            ->pluck('total', 'kabupaten')
            ->toArray();

        // Visitors → jumlah open vs closed per bulan
        $bulan = $request->get('bulan_open', Carbon::now()->month);

        // Ambil tiket berdasarkan kategori untuk bulan tsb
        $visitor = Tiket::select('kategori', DB::raw('COUNT(*) as total'))
            ->where('status_tiket', 'Open')  // hanya tiket yang Open
            ->whereMonth('created_at', $bulan) // filter bulan
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // Data tabel (site)
        $sites = Tiket::select('nama_site', 'site_id', 'status_tiket', 'durasi')
            ->where('status_tiket', 'open') // hanya ambil tiket dengan status open
            ->paginate(10);

        // === Grafik DONE per tanggal (dari PmLiberta) ===
        $doneData = PmLiberta::select(
                DB::raw('YEAR(date) as tahun'),
                DB::raw('MONTH(date) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('status', 'done')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        // Buat label nama bulan
        $labels = $doneData->map(function ($item) {
            return Carbon::createFromDate($item->tahun, $item->bulan, 1)->translatedFormat('F Y');
        });

        // Ambil jumlah total
        $values = $doneData->pluck('total');

        // Hitung jumlah done per kategori
        $kategoriDone = \DB::table('pm_liberta')
            ->select('kategori', \DB::raw('COUNT(*) as total'))
            ->where('status', 'done')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // Hitung total semua done
        $totalDone = \DB::table('pm_liberta')
            ->where('status', 'done')
            ->count();

        $tiket = Tiket::all();

        $today = Carbon::today();
        $now = Carbon::now();

        // Ambil semua jadwal piket hari ini
        $jadwalHariIni = JadwalPiket::with('user')
            ->whereDate('tanggal', $today)
            ->get();

        // Tentukan shift aktif sekarang
        $shiftAktif = null;
        if ($now->between(Carbon::createFromTime(8, 0), Carbon::createFromTime(15, 59))) {
            $shiftAktif = 'P';
        } elseif ($now->between(Carbon::createFromTime(16, 0), Carbon::createFromTime(23, 59))) {
            $shiftAktif = 'S';
        } else {
            $shiftAktif = 'M';
        }

        // Tentukan siapa yang sedang aktif
        $piketAktif = $jadwalHariIni->where('shift', $shiftAktif);

        return view('mydashboard', compact(
            'totalTiket','tiketOpen','tiketClosed','tiketToday',
            'totalPm','pmDone','pmPending','monthlyTiket',
            'tasks','statKab','visitor','bulan','sites',
            'labels','values', 'kategoriDone','totalDone', 'tiket', 'bulan', 'jadwalHariIni', 'piketAktif', 'shiftAktif', 'today'
        ));
    }
}