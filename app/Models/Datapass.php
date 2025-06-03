<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datapass extends Model
{
    protected $table = 'datapass'; 
    protected $fillable = [
        'site_id',
        'nama_lokasi',
        'kabupaten',
        'adop',
        'pass_ap1',
        'pass_ap2',
    ];

}
