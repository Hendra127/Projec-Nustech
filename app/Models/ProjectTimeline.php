<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    use HasFactory;

    protected $table = 'project_timeline';

    protected $fillable = [
        'nama_lokasi',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
