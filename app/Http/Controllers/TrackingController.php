<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use App\Imports\TrackingImport;
use App\Exports\TrackingExport;
use Maatwebsite\Excel\Facades\Excel;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking');
    }

    public function getData()
    {
        return response()->json(Tracking::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_perangkat' => 'required',
            'jenis' => 'required',
            'tipe' => 'required',
            'sn' => 'required|unique:tracking,sn',
            'kondisi' => 'required',
        ]);
        $tracking = Tracking::create($data);
        return response()->json($tracking);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_perangkat' => 'required',
            'jenis' => 'required',
            'tipe' => 'required',
            'sn' => 'required',
            'kondisi' => 'required',
        ]);
        $tracking = Tracking::findOrFail($id);
        $tracking->update($data);
        return response()->json($tracking);
    }

    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx']);
        Excel::import(new TrackingImport, $request->file('file'));
        return response()->json(['message' => 'Import berhasil']);
    }

    public function export()
    {
        return Excel::download(new TrackingExport, 'tracking.xlsx');
    }
}
