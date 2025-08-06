<?php

namespace App\Http\Controllers;

use App\Models\Sla;
use App\Imports\SlaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\SlaSheetImport;
use App\Imports\SlaSingleSheetImport;
use App\Imports\SlaMultiSheetImport;
use Maatwebsite\Excel\Excel as ExcelFormat;
use PhpOffice\PhpSpreadsheet\IOFactory;


class SlaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nama sheet aktif dari query string (default: sheet1)
        $activeSheet = $request->get('sheet', 'sheet1');

        // Ambil data untuk tiap sheet
        $data = DB::table('slas')->where('sheet', 'sheet1')->get();
        $data2 = DB::table('slas')->where('sheet', 'sheet2')->get();
        $data3 = DB::table('slas')->where('sheet', 'sheet3')->get();

        return view('sla', compact('data', 'data2', 'data3', 'activeSheet'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'sheet' => 'required|in:sheet1,sheet2,sheet3'
        ]);

        $sheetInput = $request->input('sheet');
        $file = $request->file('file');

        // Hanya hapus data pada sheet yang dipilih, bukan truncate seluruh tabel
        \DB::table('slas')->where('sheet', $sheetInput)->delete();

        // Import hanya sheet yang dipilih
        Excel::import(new SlaSheetImport($sheetInput), $file);

        // Pastikan data hasil import diberi nilai sheet sesuai pilihan
        \DB::table('slas')->whereNull('sheet')->update(['sheet' => $sheetInput]);

        return redirect()->route('sla.index', ['sheet' => $sheetInput])
                        ->with('success', 'Import berhasil ke ' . ucfirst($sheetInput) . '!');
    }

    public function updateInline(Request $request, $id)
    {
        $sla = Sla::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        $allowedFields = ['snmp_modem', 'snmp_router', 'snmp_ap1', 'snmp_ap2', 'uptime_zabbix'];
        if (!in_array($field, $allowedFields)) {
            return response()->json(['success' => false, 'message' => 'Field tidak diizinkan']);
        }

        $cleanValue = floatval(str_replace('%', '', $value));
        $sla->$field = $cleanValue;

        $modem = floatval($field === 'snmp_modem' ? $cleanValue : $sla->snmp_modem);
        $router = floatval($field === 'snmp_router' ? $cleanValue : $sla->snmp_router);
        $ap1 = floatval($field === 'snmp_ap1' ? $cleanValue : $sla->snmp_ap1);
        $ap2 = floatval($field === 'snmp_ap2' ? $cleanValue : $sla->snmp_ap2);
        $uptimeZabbix = floatval($field === 'uptime_zabbix' ? $cleanValue : $sla->uptime_zabbix);

        $sla->rata_rata_perangkat = round(($modem + $router + $ap1 + $ap2) / 4, 2);
        $sla->rata_rata_ap1_ap2 = round(($ap1 + $ap2) / 2, 2);

        $sla->uptime_perhari = intval($uptimeZabbix / 3600 / 31);
        $sla->uptime_perhari_menit = intval($uptimeZabbix / 60 / 28);

        $sla->save();

        return response()->json(['success' => true]);
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'site_id' => 'nullable|string',
        'nama_lokasi' => 'nullable|string',
        'snmp_modem' => 'nullable|numeric',
        'snmp_router' => 'nullable|numeric',
        'snmp_ap1' => 'nullable|numeric',
        'snmp_ap2' => 'nullable|numeric',
        'uptime_zabbix' => 'nullable|numeric',
    ]);

    // Tambahkan nilai sheet default ke sheet3
    $validated['sheet'] = 'sheet3';

    // Hitung nilai tambahan
    $modem = floatval($validated['snmp_modem'] ?? 0);
    $router = floatval($validated['snmp_router'] ?? 0);
    $ap1 = floatval($validated['snmp_ap1'] ?? 0);
    $ap2 = floatval($validated['snmp_ap2'] ?? 0);
    $uptimeZabbix = floatval($validated['uptime_zabbix'] ?? 0);

    $validated['rata_rata_perangkat'] = round(($modem + $router + $ap1 + $ap2) / 4, 2);
    $validated['rata_rata_ap1_ap2'] = round(($ap1 + $ap2) / 2, 2);
    $validated['uptime_perhari'] = intval($uptimeZabbix / 3600 / 31);
    $validated['uptime_perhari_menit'] = intval($uptimeZabbix / 60 / 28);

    $sla = Sla::create($validated);

    return response()->json(['success' => true, 'id' => $sla->id]);
}
public function showImportForm(Request $request)
{
    $sheetNames = [];
    if ($request->hasFile('file')) {
        $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
        $sheetNames = $spreadsheet->getSheetNames();
    }
    return view('sla.import', compact('sheetNames'));
}

}

