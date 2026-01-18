<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTimeline;

class ProjectTimelineController extends Controller
{
    public function index()
    {
        $totalSite = ProjectTimeline::count();
        $doneSite = ProjectTimeline::where('status', 'done')->count();
        $progressSite = ProjectTimeline::where('status', 'progress')->count();
        $sisaSite = $totalSite - $doneSite;
        $progress = $totalSite > 0 ? round(($doneSite / $totalSite) * 100) : 0;
        $timeline = ProjectTimeline::orderBy('tanggal', 'asc')->get();

        return view('timeline', compact(
            'totalSite',
            'doneSite',
            'progressSite',
            'sisaSite',
            'progress',
            'timeline'
        ));
    }
    public function create()
{
    return view('project.projecttimeline_create'); // form manual
}
//timeline manual
public function store(Request $request)
{
    $request->validate([
        'nama_lokasi' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'status' => 'required|in:pending,progress,done',
    ]);

    ProjectTimeline::create([
        'nama_lokasi' => $request->nama_lokasi,
        'tanggal' => $request->tanggal,
        'status' => $request->status,
    ]);

    return redirect()->route('timeline.index')->with('success', 'Timeline site berhasil ditambahkan!');
}

}
