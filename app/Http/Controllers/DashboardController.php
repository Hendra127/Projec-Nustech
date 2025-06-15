<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasite;
use App\Models\Tiket;
use App\Models\User;
use App\Models\LogPerangkat;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        try {
            $siteCount = Datasite::count();
            $tiketOpenCount = Tiket::where('status_tiket', 'OPEN')->count();
            $tiketCloseCount = Tiket::where('status_tiket', 'CLOSE')->count();
            $userCount = User::count();
            $activeUserCount = User::where('is_online', true)->count();
            
            $today = Carbon::today(); // Mendapatkan tanggal hari ini
            $tiketCloseTodayCount = Tiket::where('status_tiket', 'CLOSE')
                ->whereDate('tanggal_close', $today)
                ->count();

            $yesterday = Carbon::yesterday();
            $tiketOpenYesterdayCount = Tiket::where('status_tiket', 'OPEN')
                ->whereDate('tanggal_rekap', $yesterday)
                ->count();

            $keteranganCount = DB::table('log_perangkat')
                ->select('keterangan', DB::raw('count(*) as total'))
                ->groupBy('keterangan')
                ->orderBy('total', 'desc') // opsional
                ->get();

            $keteranganList = LogPerangkat::select('keterangan')
                        ->distinct()
                        ->orderBy('keterangan')
                        ->pluck('keterangan');

            $selectedKeterangan = request('keterangan');

            $logPerangkatTeknisi = LogPerangkat::when($selectedKeterangan, function ($query) use ($selectedKeterangan) {
                return $query->where('keterangan', $selectedKeterangan);
            })->latest()->get();

            // Ini Fungsi untuk mengambil jumlah site berdasarkan kabupaten
            $siteByKabupaten = DataSite::select('kab', DB::raw('count(*) as total'))
                ->groupBy('kab')
                ->get(); 

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

            // Gabungkan hasil open & close per bulan
            $timeseries  = collect($data)
                ->groupBy('bulan')
                ->map(function ($items) {
                    return [
                        'bulan'        => $items->first()->bulan,
                        'total_open'   => $items->sum('total_open'),
                        'total_close'  => $items->sum('total_close'),
                    ];
                })
                ->sortBy('bulan')
                ->values()
                ->all();

            $data = DB::table('tiket')
                ->select('bulan_close', DB::raw('count(*) as total_close'))
                ->whereNotNull('bulan_close')
                ->where('bulan_close', '!=', 'BELUM CLOSE')
                ->groupBy('bulan_close')
                ->orderBy('bulan_close')
                ->get();

            // Ambil 2 bulan terakhir
            $lastTwo = $data->take(-2)->values();

             $allTiket = Tiket::where('status_tiket', 'OPEN')
                ->orderBy('created_at')
                ->get();



            if ($lastTwo->count() < 2) {
                $deltaMonth = '-';
                $delta = 0; // Kalau data bulan sebelumnya gak ada
            } else {
                $deltaMonth = $lastTwo[0]->bulan_close;
                $delta = $lastTwo[0]->total_close - $lastTwo[1]->total_close;
            }

            return view('dashboard', compact('timeseries', 'delta', 'deltaMonth', 'siteCount', 'tiketOpenCount', 'tiketCloseCount', 'userCount', 'allTiket', 'siteByKabupaten', 'activeUserCount', 'logPerangkatTeknisi', 'keteranganList', 'selectedKeterangan', 'keteranganCount', 'tiketCloseTodayCount', 'tiketOpenYesterdayCount'));
        } catch (\Throwable $th) {
            dd($th);
            return abort(404);
        }
    }
    public function getActiveUsers()
    {
        $activeUsers = User::where('last_seen', '>=', Carbon::now()->subMinutes(1))->count();
        return response()->json(['active_users' => $activeUsers]);
    }
}
