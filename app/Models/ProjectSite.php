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
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function groups()
    {
        return $this->belongsToMany(ProjectTimelineGroup::class, 'group_site', 'project_site_id', 'group_id')
            ->withPivot('status')
            ->withTimestamps();
    }

}
