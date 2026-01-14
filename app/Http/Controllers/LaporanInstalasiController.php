<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanInstalasi;
use App\Models\Sitenewinsalasion;

class LaporanInstalasiController extends Controller
{
    public function index()
    {
        $dokumentasi = LaporanInstalasi::latest()->get();
        return view('laporaninstalasi', compact('dokumentasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'foto.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        foreach ($request->file('foto') as $file) {

            // 🔥 PALING AMAN (tanpa spasi, tanpa karakter aneh)
            $path = $file->store('photos', 'public');

            LaporanInstalasi::create([
                'nama_foto' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'keterangan' => $request->keterangan,
                'path' => $path // <-- SIMPAN: photos/xxxx.jpg
            ]);
        }

        return redirect()->back()->with('success', 'Foto berhasil diupload.');
    }
    public function storeInstallation(Request $request)
    {
        $request->validate([
            'nama_site' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $site = Sitenewinsalasion::create([
            'nama_site' => $request->nama_site,
            'keterangan' => $request->keterangan
        ]);

        return redirect()
            ->route('installation.show', $site->id)
            ->with('success', 'Installation Data berhasil disimpan');
    }
    public function approve(Request $request)
    {
        $item = LaporanInstalasi::findOrFail($request->id);
        $item->status = 'approved';
        $item->reject_reason = null;
        $item->save();

        return response()->json(['success' => true, 'message' => 'Foto telah diapprove.']);
    }

    public function reject(Request $request)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ]);

        $item = LaporanInstalasi::findOrFail($request->id);
        $item->status = 'rejected';
        $item->reject_reason = $request->reject_reason;
        $item->save();

        return response()->json(['success' => true, 'message' => 'Foto telah direject.']);
    }

}
