<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanInstalasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LaporanInstalasiController extends Controller
{
    // ================= HALAMAN =================
    public function index()
    {
        $laporan = LaporanInstalasi::latest()->get();
        return view('laporaninstalasi', compact('laporan'));
    }

    // ================= STORE (UPLOAD FOTO) =================
    public function store(Request $request)
    {
        if (!$request->has('items')) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data foto'
            ], 422);
        }

        foreach ($request->items as $itemKey => $itemData) {

            if (!isset($itemData['foto'])) continue;

            $file = $itemData['foto'];
            if (!$file->isValid()) continue;

            // nama file
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('laporan_instalasi', $filename, 'public');

            // hapus file lama (jika ada)
            $old = LaporanInstalasi::where('nama_foto', $itemKey)
                    ->latest()
                    ->first();

            if ($old && $old->path && Storage::disk('public')->exists($old->path)) {
                Storage::disk('public')->delete($old->path);
            }

            // simpan / update DB
            LaporanInstalasi::updateOrCreate(
                ['nama_foto' => $itemKey],
                [
                    'keterangan'    => $itemData['keterangan'] ?? null,
                    'path'          => $path,
                    'status'        => 'pending',
                    'reject_reason' => null,
                ]
            );
        }

        return response()->json(['success' => true]);
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
