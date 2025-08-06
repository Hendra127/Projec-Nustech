<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmLiberta extends Model
{
    use HasFactory;

    protected $table = 'pm_liberta';

    protected $fillable = [
        'site_id',
        'nama_lokasi',
        'provinsi',
        'kabupaten_kota',
        'pic_ce',
        'month',
        'date',
        'status',
        'week',
        'kategori',
    ];
}