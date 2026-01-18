<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectSite;

class SiteReviewController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('mitra')->get();
        return view('sitereview', compact('projects'));
    }

    // AJAX untuk load site
    public function filter(Request $request)
    {
        $query = ProjectSite::with('project');

        if($request->project_id) $query->where('project_id', $request->project_id);
        if($request->provinsi) $query->where('provinsi', $request->provinsi);
        if($request->kabupaten) $query->where('kabupaten', $request->kabupaten);
        if($request->kecamatan) $query->where('kecamatan', $request->kecamatan);
        if($request->search){
            $query->where(function($q) use($request){
                $q->where('site_id','like','%'.$request->search.'%')
                  ->orWhere('site_name','like','%'.$request->search.'%');
            });
        }

        return response()->json($query->orderBy('id','desc')->get());
    }

    // Simpan site baru
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
