<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPerangkat extends Model
{
    use HasFactory;

    protected $table = 'log_perangkat';
    protected $fillable = [
        'site_id', 'nama', 'perangkat', 'tanggal_pergantian',
        'sn_lama', 'sn_baru', 'keterangan'
    ];
}