<?php

namespace App\Exports;

use App\Models\PmLiberta;
use Maatwebsite\Excel\Concerns\FromCollection;

class PmLibertaExport implements FromCollection
{
    public function collection()
    {
        return PmLiberta::all();
    }
}