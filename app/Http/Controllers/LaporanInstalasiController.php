<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumentasi;



class LaporanInstalasiController extends Controller
{
    // Tampilkan halaman utama
    public function index()
    {
        $dokumentasi = Dokumentasi::latest()->get();
        return view('laporaninstalasi', compact('dokumentasi'));
    }

    // Proses upload foto
    public function uploadFoto(Request $request)
{
    \Log::info('Upload dipanggil');
    \Log::info($request->all());

    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'nama_foto' => 'required|string|max:255',
        'keterangan' => 'nullable|string',
    ]);

    $file = $request->file('foto');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('public/photos', $filename);

    Dokumentasi::create([
        'nama_foto' => $request->nama_foto,
        'keterangan' => $request->keterangan,
        'path' => 'storage/photos/' . $filename,
    ]);

    \Log::info('Berhasil simpan ke database');

    return redirect()->route('laporaninstalasi')->with('success', 'Foto berhasil diupload.');
}

    public function store(Request $request)
{
    $request->validate([
        'keterangan' => 'required',
        'foto.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasfile('foto')) {
        foreach ($request->file('foto') as $file) {
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/photos', $filename);

            Dokumentasi::create([
                'nama_foto' => $file->getClientOriginalName(),
                'keterangan' => $request->keterangan,
                'path' => 'storage/photos/' . $filename
            ]);
        }
    }

    return redirect()->back()->with('success', 'Foto berhasil diupload.');
}

}
