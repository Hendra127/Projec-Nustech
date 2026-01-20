<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTimelineGroup;
use App\Models\ProjectSite;

class ProjectTimelineGroupController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $groups = ProjectTimelineGroup::with(['sites.project'])
            ->orderBy('tanggal_mulai')
            ->get();

        // filter groups by status
        if ($filter == 'done') {
            $groups = $groups->filter(function ($group) {
                return $group->sites->every(fn($s) => $s->pivot->status == 'done');
            });
        } elseif ($filter == 'pending') {
            $groups = $groups->filter(function ($group) {
                return $group->sites->contains(fn($s) => $s->pivot->status != 'done');
            });
        }

        return view('timeline', compact('groups', 'filter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string',
            'project_site_ids' => 'required|array',
            'project_site_ids.*' => 'exists:project_sites,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $group = ProjectTimelineGroup::create([
            'group_name' => $request->group_name,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        $siteIds = $request->project_site_ids;
        $attach = [];
        foreach ($siteIds as $id) {
            $attach[$id] = ['status' => 'pending'];
        }
        $group->sites()->attach($attach);

        return redirect()->route('timeline.index')
            ->with('success', 'Group timeline berhasil dibuat');
    }
}
