<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectSite;
use App\Models\LaporanInstalasi;

class SiteReviewController extends Controller
{
    public function index(Project $project)
    {
        $projects = Project::orderBy('mitra')->get();
        $selectedProjectId = $project->id;

        return view('sitereview', compact('projects', 'selectedProjectId'));
    }

    // ================= AJAX LOAD SITE + PROGRESS =================
    public function filter(Request $request)
{
    $TOTAL_TARGET = 43;

    $query = ProjectSite::with('project');

    if ($request->project_id) {
        $query->where('project_id', $request->project_id);
    }

    if ($request->provinsi) {
        $query->where('provinsi', 'like', "%{$request->provinsi}%");
    }

    if ($request->kabupaten) {
        $query->where('kabupaten', 'like', "%{$request->kabupaten}%");
    }

    if ($request->kecamatan) {
        $query->where('kecamatan', 'like', "%{$request->kecamatan}%");
    }

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('site_id', 'like', "%{$request->search}%")
              ->orWhere('site_name', 'like', "%{$request->search}%");
        });
    }

    $sites = $query->orderBy('id', 'desc')->get();

    $sites->transform(function ($site) use ($TOTAL_TARGET) {

        // ✅ INI KUNCINYA
        $approvedCount = LaporanInstalasi::where('project_site_id', $site->id)
            ->where('status', 'approved')
            ->count();

        $site->progress = floor(($approvedCount / $TOTAL_TARGET) * 100);

        // optional buat debug / tooltip
        $site->approved_count = $approvedCount;
        $site->total_target  = $TOTAL_TARGET;

        return $site;
    });

    return response()->json($sites);
}

    // ================= SIMPAN SITE BARU =================
    public function storeSite(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'site_name'  => 'required',
            'site_id'    => 'required',
            'provinsi'   => 'required',
            'kabupaten'  => 'required',
            'kecamatan'  => 'required',
        ]);

        $site = ProjectSite::create($data);

        return response()->json([
            'success' => true,
            'site' => $site
        ]);
    }
}
