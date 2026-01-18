<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanInstalasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProjectSite;
class LaporanInstalasiController extends Controller
{
    // ================= HALAMAN =================
    public function index()
    {
        $projectSites = ProjectSite::orderBy('site_name')->get();
        $laporan = LaporanInstalasi::latest()->get();
        return view('laporaninstalasi', compact('projectSites', 'laporan'));
    }

    // ================= STORE (UPLOAD FOTO) =================
    public function store(Request $request)
    {
        $request->validate([
            'project_site_id' => 'required|exists:project_sites,id',
            'items' => 'required|array',
        ]);

        $projectSiteId = $request->project_site_id;

        foreach ($request->items as $itemKey => $itemData) {

            if (!isset($itemData['foto'])) continue;

            $file = $itemData['foto'];
            if (!$file->isValid()) continue;

            // 🔹 nama file unik
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // 🔹 folder PER SITE
            $path = $file->storeAs(
                "laporan_instalasi/site_{$projectSiteId}",
                $filename,
                'public'
            );

            // 🔹 cari data lama (PER SITE)
            $old = LaporanInstalasi::where('project_site_id', $projectSiteId)
                ->where('nama_foto', $itemKey)
                ->latest()
                ->first();

            // 🔹 hapus file lama
            if ($old && $old->path && Storage::disk('public')->exists($old->path)) {
                Storage::disk('public')->delete($old->path);
            }

            // 🔹 simpan / update DB (PER SITE)
            LaporanInstalasi::updateOrCreate(
                [
                    'project_site_id' => $projectSiteId,
                    'nama_foto'       => $itemKey,
                ],
                [
                    'keterangan'    => $itemData['keterangan'] ?? null,
                    'path'          => $path,
                    'status'        => 'pending',
                    'reject_reason' => null,
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Laporan instalasi berhasil disimpan'
        ]);
    }

    // ================= APPROVE =================
    public function approve(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            abort(403);
        }

        $laporan = LaporanInstalasi::findOrFail($request->id);

        $laporan->update([
            'status' => 'approved',
            'reject_reason' => null
        ]);

        return response()->json(['success' => true]);
    }

    // ================= REJECT =================
    public function reject(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'reject_reason' => 'required|string'
        ]);

        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            abort(403);
        }

        $laporan = LaporanInstalasi::findOrFail($request->id);

        $laporan->update([
            'status' => 'rejected',
            'reject_reason' => $request->reject_reason
        ]);

        return response()->json(['success' => true]);
    }
}
