<?php

namespace App\Exports;

use App\Models\LaporanPM;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanPMExport implements FromCollection
{
    public function collection()
    {
        return LaporanPM::all();
    }
}
