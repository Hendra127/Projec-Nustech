<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTimeline;
use App\Models\ProjectSite;
use Carbon\Carbon;

class ProjectTimelineController extends Controller
{
    public function index()
    {
        $sites = ProjectSite::orderBy('site_name')->get();
        $timeline = ProjectTimeline::with('site')->orderBy('tanggal_mulai')->get();

        $totalSite = $timeline->count();
        $doneSite = $timeline->where('status', 'done')->count();
        $progressSite = $timeline->where('status', 'progress')->count();
        $sisaSite = $totalSite - $doneSite;
        $progress = $totalSite > 0 ? round(($doneSite / $totalSite) * 100) : 0;

        return view('timeline', compact(
            'sites',
            'timeline',
            'totalSite',
            'doneSite',
            'progressSite',
            'sisaSite',
            'progress'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_site_id' => 'required|exists:project_sites,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:pending,progress,done',
        ]);

        ProjectTimeline::create([
            'project_site_id' => $request->project_site_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline berhasil ditambahkan');
    }
}
