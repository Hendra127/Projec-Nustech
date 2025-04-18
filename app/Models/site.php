<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = "datasite";
    protected $primaryKey = "id";
    protected $fillable = [
    'no',
    'tanggal',
    'site_id',
    'lokasi',
    'kabupaten_kota',
    'provinsi',
    'pm_bulan',
    'laporan_ba_pm',
    'teknisi',
    'kendala',
    'action',
    'ket',
    ];
}
