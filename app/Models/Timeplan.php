<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Timeplan.php
class Timeplan extends Model
{
    protected $fillable = [
        'project_site_id',
        'jumlah_site',
        'teknisi',
        'start_date'
    ];

    public function projectSite()
    {
        return $this->belongsTo(ProjectSite::class);
    }
}
