<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectSite;

class NewProjectController extends Controller
{
    // =============================
    // HALAMAN UTAMA + LIST PROJECT
    // =============================
    public function index()
    {
        $projects = Project::with('sites')->get();
        return view('newproject', compact('projects'));
    }

    // =============================
    // SIMPAN PROJECT PHASE BARU
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'no_kontrak' => 'required',
            'mitra'      => 'required',
            'batch'      => 'required',
            'phase'      => 'required',
        ]);

        Project::create($request->only([
            'no_kontrak','mitra','batch','phase'
        ]));

        return redirect()->route('newproject')
            ->with('success','Project Phase berhasil ditambahkan');
    }

    // =============================
    // HAPUS PROJECT
    // =============================
    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return back()->with('success','Project berhasil dihapus');
    }
}
