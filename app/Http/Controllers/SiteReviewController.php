<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewProject;
use App\Models\Card; // model project phase
use Illuminate\Support\Facades\DB;

class SiteReviewController extends Controller
{
    // =====================
    // HALAMAN UTAMA
    // =====================
    public function index()
    {
        // Ambil semua site
        $sites = NewProject::with('card') // pastikan relasi card ada di model NewProject
            ->orderBy('id', 'desc')
            ->get();

        // Ambil daftar project phase dari tabel cards
        $projectPhases = Card::orderBy('title')->get();

        // Ambil daftar provinsi unik
        $provinsiList = DB::table('newprojects')
            ->select('provinsi')
            ->whereNotNull('provinsi')
            ->distinct()
            ->orderBy('provinsi')
            ->pluck('provinsi');

        // Ambil daftar kabupaten unik
        $kabupaten = DB::table('newprojects')
            ->select('kab')
            ->whereNotNull('kab')
            ->distinct()
            ->orderBy('kab')
            ->pluck('kab');

        // Ambil daftar kecamatan unik
        $kecamatan = DB::table('newprojects')
            ->select('kecamatan')
            ->whereNotNull('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');

        // Ambil daftar batch unik
        $batchList = DB::table('newprojects')
            ->select('batch')
            ->whereNotNull('batch')
            ->distinct()
            ->orderBy('batch')
            ->pluck('batch');

        // Kirim semua variabel ke view
        return view('sitereview', compact(
            'sites',
            'projectPhases',
            'provinsiList',
            'kabupaten',
            'kecamatan',
            'batchList'
        ));
    }

    // =====================
    // FILTER AJAX
    // =====================
    public function filter(Request $request)
    {
        $query = NewProject::with('card');

        if ($request->card_id) {
            $query->where('card_id', $request->card_id);
        }

        if ($request->provinsi) {
            $query->where('provinsi', $request->provinsi);
        }

        if ($request->kabupaten) {
            $query->where('kab', $request->kabupaten);
        }

        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->batch) {
            $query->where('batch', $request->batch);
        }
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('site_id', 'like', '%'.$request->search.'%')
                ->orWhere('sitename', 'like', '%'.$request->search.'%');
            });
        }

        $sites = $query->orderBy('id', 'desc')->get();

        return response()->json($sites);
    }
}
