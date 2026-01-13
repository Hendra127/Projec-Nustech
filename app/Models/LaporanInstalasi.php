<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanInstalasi extends Model
{
    use HasFactory;

    protected $table = 'laporan_instalasi';

    protected $fillable = [
        'nama_foto',
        'keterangan',
        'path',
    ];
}
