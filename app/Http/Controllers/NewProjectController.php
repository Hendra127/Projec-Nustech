<?php

namespace App\Http\Controllers;

use App\Models\NewProject;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\NewProjectImport;
use App\Exports\NewProjectExport;
use Maatwebsite\Excel\Facades\Excel;

class NewProjectController extends Controller
{
    // ===============================
    // TAMPILKAN DATA (DENGAN CARD)
    // ===============================
    public function index(Request $request)
    {
        $role = Auth::user()->role; // ✅ FIX Undefined variable $role

        // Ambil card + project
        $cards = Card::with(['newprojects' => function ($q) use ($request) {

            // SEARCH
            if ($request->filled('query')) {
                $q->where('site_id', 'like', '%' . $request->query('query') . '%')
                  ->orWhere('sitename', 'like', '%' . $request->query('query') . '%');
            }

            $q->orderBy('id', 'desc');

        }])->get();

        return view('newproject', compact('cards', 'role'));
    }

    // ===============================
    // SIMPAN DATA BARU
    // ===============================
    public function store(Request $request)
{
    $request->validate([
        'card_id' => 'required',
        'site_id' => 'required',
        'sitename' => 'required',
    ]);

    NewProject::create([
        'card_id' => $request->card_id,
        'site_id' => $request->site_id,
        'sitename' => $request->sitename,
        'tipe' => $request->tipe,
        'batch' => $request->batch,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'provinsi' => $request->provinsi,
        'kab' => $request->kab,
        'kecamatan' => $request->kecamatan,
        'kelurahan' => $request->kelurahan,
        'alamat_lokasi' => $request->alamat_lokasi,
        'nama_pic' => $request->nama_pic,
        'nomor_pic' => $request->nomor_pic,
        'sumber_listrik' => $request->sumber_listrik,
        'gateway_area' => $request->gateway_area,
        'beam' => $request->beam,
        'hub' => $request->hub,
        'kodefikasi' => $request->kodefikasi,
        'sn_antena' => $request->sn_antena,
        'sn_modem' => $request->sn_modem,
        'sn_router' => $request->sn_router,
        'sn_ap1' => $request->sn_ap1,
        'sn_ap2' => $request->sn_ap2,
        'sn_tranciever' => $request->sn_tranciever,
        'sn_stabilizer' => $request->sn_stabilizer,
        'sn_rak' => $request->sn_rak,
        'ip_modem' => $request->ip_modem,
        'ip_router' => $request->ip_router,
        'ip_ap1' => $request->ip_ap1,
        'ip_ap2' => $request->ip_ap2,
        'expected_sqf' => $request->expected_sqf,
    ]);

    return back()->with('success','Data berhasil ditambahkan');
}


    // ===============================
    // DETAIL DATA (AJAX)
    // ===============================
    public function show($id)
    {
        $data = NewProject::find($id);

        if ($data) {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $project = NewProject::findOrFail($id);

        $request->validate([
            'site_id' => 'required|string',
            'sitename' => 'required|string',
            'tipe' => 'nullable|string',
            'batch' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kab' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'alamat_lokasi' => 'nullable|string',
            'nama_pic' => 'nullable|string',
            'nomor_pic' => 'nullable|string',
            'sumber_listrik' => 'nullable|string',
            'gateway_area' => 'nullable|string',
            'beam' => 'nullable|string',
            'hub' => 'nullable|string',
            'kodefikasi' => 'nullable|string',
            'sn_antena' => 'nullable|string',
            'sn_modem' => 'nullable|string',
            'sn_router' => 'nullable|string',
            'sn_ap1' => 'nullable|string',
            'sn_ap2' => 'nullable|string',
            'sn_tranciever' => 'nullable|string',
            'sn_stabilizer' => 'nullable|string',
            'sn_rak' => 'nullable|string',
            'ip_modem' => 'nullable|string',
            'ip_router' => 'nullable|string',
            'ip_ap1' => 'nullable|string',
            'ip_ap2' => 'nullable|string',
            'expected_sqf' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('newproject')
            ->with('success', 'Data berhasil diperbarui.');
    }

    // ===============================
    // HAPUS DATA
    // ===============================
    public function destroy($id)
    {
        $project = NewProject::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
    // ===============================
    // EXPORT EXCEL
    // ===============================
    public function export()
    {
        return Excel::download(new NewProjectExport, 'newproject.xlsx');
    }

    // ===============================
    // IMPORT EXCEL
    // ===============================
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new NewProjectImport, $request->file('file'));

        return redirect()->back()->with('success', 'Import berhasil!');
    }
}
