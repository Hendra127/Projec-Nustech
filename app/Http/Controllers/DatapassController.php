<?php

namespace App\Http\Controllers;

use App\Models\Datapass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatapassImport;
use App\Exports\DatapassExport;

use App\Http\Controllers\Controller;
class DatapassController extends Controller
{
    public function index()
    {
        $datapass = Datapass::all();
        return view('datapass', compact('datapass'));
    }

    public function store(Request $request)
    {
        Datapass::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data = Datapass::findOrFail($id);
        $data->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Datapass::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function import(Request $request)
    {
        Excel::import(new DatapassImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

    public function export()
    {
        return Excel::download(new DatapassExport, 'datapass.xlsx');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $datapass = Datapass::where('site_id', 'like', "%$query%")
            ->orWhere('nama_lokasi', 'like', "%$query%")
            ->orWhere('kabupaten', 'like', "%$query%")
            ->orWhere('adop', 'like', "%$query%")
            ->orWhere('pass_ap1', 'like', "%$query%")
            ->orWhere('pass_ap2', 'like', "%$query%")
            ->get();

        return view('datapass', compact('datapass'));
    }
}
