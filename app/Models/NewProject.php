<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProject extends Model
{
    protected $table = 'newprojects'; // Nama tabel di 
    protected $primaryKey = 'id';   // Primary key-nya
    public $timestamps = false;     // Jika tidak menggunakan created_at dan updated_at

    // Daftar kolom yang bisa diisi secara massal
    protected $fillable = [
        'card_id',
        'no',
        'site_id',
        'sitename',
        'tipe',
        'batch',
        'latitude',
        'longitude',
        'provinsi',
        'kab',
        'kecamatan',
        'kelurahan',
        'alamat_lokasi',
        'nama_pic',
        'nomor_pic',
        'sumber_listrik',
        'gateway_area',
        'beam',
        'hub',
        'kodefikasi',
        'sn_antena',
        'sn_modem',
        'sn_router',
        'sn_ap1',
        'sn_ap2',
        'sn_tranciever',
        'sn_stabilizer',
        'sn_rak',
        'ip_modem',
        'ip_router',
        'ip_ap1',
        'ip_ap2',
        'expected_sqf',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
