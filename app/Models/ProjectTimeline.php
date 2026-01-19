<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    protected $table = 'project_timeline';

    protected $fillable = [
        'project_site_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function site()
    {
        return $this->belongsTo(ProjectSite::class, 'project_site_id');
    }
}

