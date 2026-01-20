<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTimeline;
use App\Models\ProjectSite;
use Carbon\Carbon;

class ProjectTimelineController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all / done / pending

        // =========================
        // Ambil timeline
        // =========================
        $timeline = ProjectTimeline::with(['site.project'])
            ->orderBy('tanggal_mulai')
            ->get();

        // =========================
        // Hitung ringkasan dari semua data (tidak terpengaruh filter)
        // =========================
        $totalSiteAll = $timeline->count();
        $doneSiteAll = $timeline->where('status', 'done')->count();
        $progressSiteAll = $timeline->where('status', 'progress')->count();
        $sisaSiteAll = $totalSiteAll - $doneSiteAll;
        $progressAll = $totalSiteAll > 0 ? round(($doneSiteAll / $totalSiteAll) * 100) : 0;

        // =========================
        // Filter timeline
        // =========================
        if ($filter == 'done') {
            $timeline = $timeline->where('status', 'done');
        } elseif ($filter == 'pending') {
            $timeline = $timeline->whereIn('status', ['pending', 'progress']);
        }

        // =========================
        // Grouping by week (berdasarkan tanggal mulai)
        // =========================
        $groupByWeek = $timeline->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_mulai)->format('W-Y');
        });

        $sites = ProjectSite::with('project')->orderBy('site_name')->get();

        return view('timeline', compact(
            'sites',
            'timeline',
            'totalSiteAll',
            'doneSiteAll',
            'progressSiteAll',
            'sisaSiteAll',
            'progressAll',
            'filter',
            'groupByWeek'
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

        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);

        $durasi = $mulai->diffInDays($selesai) + 1;

        ProjectTimeline::create([
            'project_site_id' => $request->project_site_id,
            'tanggal_mulai' => $mulai,
            'tanggal_selesai' => $selesai,
            'durasi_hari' => $durasi,
            'status' => $request->status,
        ]);

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline berhasil ditambahkan');
    }

public function update(Request $request, ProjectTimeline $timeline)
{
    $request->validate([
        'project_site_id' => 'required|exists:project_sites,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required|in:pending,progress,done',
    ]);

    $timeline->update([
        'project_site_id' => $request->project_site_id,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status' => $request->status,
    ]);

    return redirect()->route('timeline.index')->with('success', 'Timeline berhasil diperbarui');
}

public function destroy(ProjectTimeline $timeline)
{
    $timeline->delete();
    return redirect()->route('timeline.index')->with('success', 'Timeline berhasil dihapus');
}

}
