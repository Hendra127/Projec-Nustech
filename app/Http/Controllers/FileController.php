<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use App\Exports\TiketExport;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\DataSiteByTiketStatusExport;
use App\Exports\LogPerangkatExport;
use App\Exports\TrackingExport;
use App\Exports\DatapassExport;

class FileController extends Controller
{
    public function index()
    {
        $files = FileUpload::all();
        return view('download_file', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('public/files');

        FileUpload::create([
            'nama_file' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
        ]);

        return redirect()->route('file.index')->with('success', 'File berhasil diupload.');
    }

    public function download($id)
    {
        $file = FileUpload::findOrFail($id);

        if (!Storage::exists($file->path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($file->path, $file->nama_file);
    }

    // Export data Tiket
    public function exportTiket()
    {
        return Excel::download(new TiketExport, 'Data_Open_Tiket.xlsx');
    }

    // Export data Datasite
    public function exportDatasite()
    {
        return Excel::download(new DataExport, 'Data_Site.xlsx');
    }

    //Log Perangkat
    public function downloadLogPerangkat()
    {
        return Excel::download(new LogPerangkatExport, 'Log_Perangkat.xlsx');
    }

    //Datapass
    public function downloadDataPass()
    {
        return Excel::download(new DatapassExport, 'Data_Pass.xlsx');
    }

    public function exportByTiketStatus()
    {
        return Excel::download(new DataSiteByTiketStatusExport, 'data-site-by-status.xlsx');
    }
    public function destroy($id)
    {
        $files = FileUpload::findOrFail($id);
        $files->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

}
