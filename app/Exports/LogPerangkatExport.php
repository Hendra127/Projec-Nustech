<?php

namespace App\Exports;

use App\Models\LogPerangkat;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogPerangkatExport implements FromCollection
{
     public function collection()
    {
        return LogPerangkat::select('site_id', 'nama', 'perangkat', 'tanggal_pergantian', 'sn_lama', 'sn_baru', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Site ID', 'Site Name', 'Perangkat', 'Tanggal', 'SN Lama', 'SN Baru', 'Keterangan'];
    }
}

