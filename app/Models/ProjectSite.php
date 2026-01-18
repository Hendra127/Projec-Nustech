<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSite extends Model
{
    protected $fillable = [
        'project_id',
        'site_id',
        'site_name',
        'provinsi',
        'kabupaten',
        'kecamatan'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
