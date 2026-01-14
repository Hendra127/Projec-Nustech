<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use Carbon\Carbon;

class BMSDashboardController extends Controller
{
    public function index()
    {
        // 🔹 Filter khusus BMS (contoh: kategori = BMS)
        $tiketBMS = Tiket::where('kategori', 'BMS');

        return view('BMSDashboard', [
            'tiketToday' => (clone $tiketBMS)
                ->whereDate('created_at', Carbon::today())
                ->count(),

            'tiketOpen' => (clone $tiketBMS)
                ->where('status_tiket', 'open')
                ->count(),

            'totalTicket' => $tiketBMS->count(),

            'tickets' => (clone $tiketBMS)
                ->latest()
                ->limit(20)
                ->get(),
        ]);
    }
}
