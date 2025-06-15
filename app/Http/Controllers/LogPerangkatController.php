<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogPerangkat;
use App\Imports\LogPerangkatImport;
use App\Exports\LogPerangkatExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDF;

class LogPerangkatController extends Controller
{
    public function index(Request $request)
    {
        $data = LogPerangkat::all();
        $sparetracker = LogPerangkat::where('keterangan', 'TEKNISI ON SITE')->get();
        return view('log_perangkat', compact('data', 'sparetracker'));
    }

    public function store(Request $request)
    {
        LogPerangkat::create($request->all());
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = LogPerangkat::findOrFail($id);
        $data->update($request->all());
        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        LogPerangkat::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);
    DB::table('log_perangkat')->truncate();

    Excel::import(new LogPerangkatImport, $request->file('file'));

    return redirect()->back()->with('success', 'Data berhasil diimpor!');
}
    public function export()
    {
        return Excel::download(new LogPerangkatExport, 'log pergantian perangkat.xlsx');
    }
   public function search(Request $request)
    {
        $search = $request->input('search');

        $data = LogPerangkat::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
            $query->orWhere('site_id', 'like', '%' . $search . '%');
            
        })->get();

        return view('log_perangkat', compact('data', 'search'));
    }

    public function exportPDF()
    {
        $data = LogPerangkat::select('site_id', 'nama', 'perangkat', 'tanggal_pergantian', 'sn_lama', 'sn_baru', 'keterangan')
        ->get();
        $pdf = PDF::loadView('log_perangkat', compact('data'))
            ->setPaper('A4', 'landscape'); // optional: landscape biar muat lebih lebar

        return $pdf->download('log-perangkat.pdf');
    }
}