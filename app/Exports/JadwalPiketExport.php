<?php

namespace App\Exports;

use App\Models\JadwalPiket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JadwalPiketExport implements FromView
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $jadwal = JadwalPiket::whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->orderBy('tanggal')
            ->get();

        return view('exports.jadwal_piket_excel', [
            'jadwal' => $jadwal,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun
        ]);
    }
}
