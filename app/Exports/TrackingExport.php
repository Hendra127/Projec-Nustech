<?php

namespace App\Exports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrackingExport implements FromCollection
{
    public function collection()
    {
        return Tracking::all();
    }
}
