<?php

namespace App\Exports;

use App\Models\Datapass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DatapassExport implements FromCollection, WithHeadings
{
    // Mengambil semua data dari model Datapass
    public function collection()
    {
        // Jika ingin memilih kolom tertentu saja, gunakan select()
        return Datapass::select('site_id', 'nama_lokasi', 'kabupaten', 'adop', 'pass_ap1', 'pass_ap2')->get();
    }

    // Membuat header kolom di file Excel
    public function headings(): array
    {
        return [
            'SITE ID',
            'NAMA LOKASI',
            'KABUPATEN',
            'ADOP',
            'PASS AP1',
            'PASS AP2',
        ];
    }
}
