<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = "tiket";
    protected $primaryKey ="id";
    protected $fillable =  [
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
        'plan_actions',
        'tanggal_close',
        'bulan_close',
        'detail_problem',
        'plan_actions',
        'ce',
    ];
 public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }
}
