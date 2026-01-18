<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'no_kontrak',
        'mitra',
        'batch',
        'phase'
    ];

    public function sites()
    {
        return $this->hasMany(ProjectSite::class);
    }

}
