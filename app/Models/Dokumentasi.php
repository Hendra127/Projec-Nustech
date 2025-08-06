<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasis';

    protected $fillable = [
        'nama_foto',
        'keterangan',
        'path',
    ];
}
