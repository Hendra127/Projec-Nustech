<?php

namespace App\Exports;

use App\Models\Tiket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSiteByTiketStatusExport implements FromCollection, WithHeadings
{
    protected $status_tiket;

    public function __construct($status_tiket)
    {
        $this->status_tiket = $status_tiket;
    }

    public function collection()
    {
        // Ambil data dari tabel tiket sesuai status
        return Tiket::with('site') // jika kamu ingin akses nama site, alamat, dll
            ->where('status_tiket', $this->status_tiket)
            ->get([
                'id',
                'site_id',
                'nama_site',
                'provinsi',
                'kabupaten',
                'durasi',
                'kategori',
                'tanggal_rekap',
                'bulan_open',
                'status_tiket',
                'kendala',
                'detail_problem',
                'plan_actions',
                'ce',
                'created_at',
            ]);
    }

    public function headings(): array
    {
        return [
            'ID Tiket',
            'ID Site',
            'Nama Site',
            'Provinsi',
            'Kabupaten',    
            'Durasi',
            'Kategori',
            'Tanggal Rekap',
            'Bulan Open',
            'Status Tiket',
            'Kendala',
            'Detail Problem',
            'Plan Actions',
            'Cluster Enginer (CE)',
            'Tanggal Dibuat',
        ];
    }
}
