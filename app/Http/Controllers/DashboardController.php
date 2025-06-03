<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasite;
use App\Models\Tiket;
use App\Models\User;

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

            return view('dashboard', compact('timeseries', 'delta', 'deltaMonth', 'siteCount', 'tiketOpenCount', 'tiketCloseCount', 'userCount', 'allTiket', 'siteByKabupaten'));
        } catch (\Throwable $th) {
            dd($th);
            return abort(404);
        }
    }
}
