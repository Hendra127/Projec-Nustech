<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewProject; // Ganti sesuai model yang digunakan
use Illuminate\Support\Facades\DB; // ✅ Tambahkan ini untuk akses DB

class SiteReviewController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel NewProject
        $sites = NewProject::all();

        // Ambil daftar provinsi unik dari tabel
        $provinsiList = DB::table('newprojects')
                    ->select('provinsi')
                    ->distinct()
                    ->orderBy('provinsi', 'asc')
                    ->pluck('provinsi');

        $kabupaten = DB::table('newprojects')
                    ->select('kab')
                    ->distinct()
                    ->orderBy('kab', 'asc')
                    ->pluck('kab');
        
        $kecamatan = DB::table('newprojects')
                    ->select('kecamatan')
                    ->distinct()
                    ->orderBy('kecamatan', 'asc')
                    ->pluck('kecamatan');
        
        $batchList = DB::table('newprojects')
                    ->select('batch')
                    ->distinct()
                    ->orderBy('batch', 'asc')
                    ->pluck('batch');

        // Kirim ke view
        return view('sitereview', compact('sites', 'provinsiList', 'kabupaten', 'kecamatan', 'batchList'));
    }
    public function filter(Request $request)
    {
        $query = NewProject::query();

        if ($request->provinsi) {
            $query->where('provinsi', $request->provinsi);
        }

        if ($request->kabupaten) {
            $query->where('kab', $request->kabupaten);
        }

        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->batch && is_array($request->batch)) {
            $query->whereIn('batch', $request->batch);
        }

        $sites = $query->get();

        // Return sebagai JSON array, bukan HTML
        return response()->json($sites);
    }

    public function filterByBatch(Request $request)
    {
        $batches = $request->input('batches');

        $query = DB::table('newprojects');

        if (!empty($batches)) {
            $query->whereIn('batch', $batches);
        }

        $filteredSites = $query->get();

        $html = '';
        foreach ($filteredSites as $index => $site) {
            $html .= '<tr>
                <td class="text-center">'.($index + 1).'</td>
                <td>'.$site->site_id.'</td>
                <td>'.$site->sitename.'</td>
                <td>'.$site->kab.'</td>
                <td>'.$site->provinsi.'</td>
                <td>'.$site->batch.'</td>
                <td class="text-center"><span class="badge bg-success">act</span></td>
            </tr>';
        }

        return $html;
    }

}
