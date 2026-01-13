<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitenewinsalasion extends Model
{
    protected $table = 'sitenewinsalasion';

    protected $fillable = [
        'nama_site',
        'keterangan'
    ];

    public function fotos()
    {
        return $this->hasMany(LaporanInstalasi::class, 'sitenewinsalasion_id');
    }
}
