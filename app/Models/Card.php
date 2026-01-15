<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['title'];

    public function newprojects()
    {
        return $this->hasMany(NewProject::class, 'card_id');
    }
}