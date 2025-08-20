<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tiket;

class SummaryTiketController extends Controller
{
    public function index(Request $request)
{
    // Ambil daftar bulan untuk dropdown
    $bulanList = Tiket::whereNotNull('bulan_open')
        ->select('bulan_open')
        ->distinct()
        ->orderBy('bulan_open', 'asc')
        ->pluck('bulan_open');

    // Query dasar
    $query = Tiket::query();
    if ($request->filled('bulan_open')) {
        $query->whereRaw("UPPER(bulan_open) = ?", [strtoupper($request->bulan_open)]);
    }

    // Open & Close tiket per bulan
    $perBulan = (clone $query)
        ->select('kategori', 'status_tiket', DB::raw('COUNT(*) as total'))
        ->groupBy('kategori', 'status_tiket')
        ->get();

    // Open tiket per hari
    $openPerHari = (clone $query)
        ->select('kategori', DB::raw('COUNT(*) as total'))
        ->where('status_tiket', 'OPEN')
        ->groupBy('kategori')
        ->get();

    // Close tiket per hari
    $closePerHari = (clone $query)
        ->select('kategori', DB::raw('COUNT(*) as total'))
        ->where('status_tiket', 'CLOSE')
        ->groupBy('kategori')
        ->get();

    // Rekap kabupaten
    $perKabupaten = (clone $query)
        ->select('kabupaten', DB::raw('COUNT(*) as total'), DB::raw('SUM(durasi) as durasi_total'))
        ->groupBy('kabupaten')
        ->orderByDesc('total')
        ->get();

    // Durasi open tiket per kabupaten
    $durasiOpenTiket = (clone $query)
        ->where('status_tiket', 'OPEN')
        ->select('kabupaten', DB::raw('SUM(durasi) as durasi_total'))
        ->groupBy('kabupaten')
        ->get();

    return view('summarytiket', compact(
        'bulanList',
        'perBulan',
        'openPerHari',
        'closePerHari',
        'perKabupaten',
        'durasiOpenTiket'
    ));
}
}
