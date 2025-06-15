<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'tracking'; // tabel di database
    protected $fillable = [
        'nama_perangkat', 'jenis', 'tipe', 'sn', 'kondisi',
        'lokasi_awal', 'kab_awal', 'lokasi_realtime', 'kab_realtime',
        'layanan_ai', 'bulan_masuk', 'tanggal_masuk',
        'bulan_keluar', 'tanggal_keluar', 'keterangan'
    ];
    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];
}

