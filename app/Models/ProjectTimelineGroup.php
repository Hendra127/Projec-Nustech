<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimelineGroup extends Model
{
    use HasFactory;

    protected $table = 'project_timeline_groups';

    protected $fillable = [
        'group_name',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function sites()
    {
        return $this->belongsToMany(ProjectSite::class, 'group_site', 'group_id', 'project_site_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function getStatusAttribute()
    {
        $total = $this->sites->count();
        $done = $this->sites->where('pivot.status', 'done')->count();

        if ($total == 0) return 'pending';
        if ($done == $total) return 'done';
        return 'progress';
    }
}
