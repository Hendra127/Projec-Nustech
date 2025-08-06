<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPM extends Model
{
    protected $table = 'laporan_pm';

    protected $fillable = [
        'tanggal_submit',
        'site_id',
        'lokasi_site',
        'kabupaten_kota',
        'provinsi',
        'pm_bulan',
        'laporan_ba_pm',
        'teknisi',
        'masalah_kendala',
        'action',
        'ket_tambahan',
        'status_laporan',
    ];
}
