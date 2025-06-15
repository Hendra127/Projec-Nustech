<?php

namespace App\Exports;

use App\Models\Tiket;
use Maatwebsite\Excel\Concerns\FromCollection;

class TiketExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Hanya ambil tiket dengan status 'open'
        return Tiket::where('status_tiket', 'OPEN')->get();
    }
}
