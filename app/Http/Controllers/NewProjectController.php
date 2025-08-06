<?php

namespace App\Http\Controllers;

use App\Models\NewProject;
use Illuminate\Http\Request;
use App\Imports\NewProjectImport;
use App\Exports\NewProjectExport;
use Maatwebsite\Excel\Facades\Excel;

class NewProjectController extends Controller
{
    // Menampilkan seluruh data
    public function index(Request $request)
    {
        $query = NewProject::query();

        if ($request->has('query')) {
            $query->where('site_id', 'like', '%' . $request->query('query') . '%')
                ->orWhere('sitename', 'like', '%' . $request->query('query') . '%');
        }

        $newprojects = $query->orderBy('id', 'desc')->paginate(10);

        return view('newproject', compact('newprojects'));
    }

    // Tampilkan form create
    public function create()
    {
        $newprojects = NewProject::paginate(10); // atau all() / get() sesuai kebutuhan

        return view('newproject', compact('newprojects'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
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

        NewProject::create($request->all());

        return redirect()->route('newproject')->with('success', 'Data berhasil ditambahkan.');
    }

    // Tampilkan form update
    public function edit($id)
    {
        $project = NewProject::findOrFail($id);
        return view('newproject.edit', compact('project'));
    }

    // Simpan perubahan
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

        return redirect()->route('newproject')->with('success', 'Data berhasil diperbarui.');
    }
    // Hapus data
    public function destroy($id)
    {
        $project = NewProject::findOrFail($id);
        $project->delete();

        return redirect()->route('newproject.index')->with('success', 'Data berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new NewProjectExport, 'newproject.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new NewProjectImport, $request->file('file'));
        return redirect()->back()->with('success', 'Import berhasil!');
    }
    public function show($id)
{
    $data = NewProject::find($id);

    if ($data) {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.'
        ], 404);
    }
}

}
