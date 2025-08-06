<?php

namespace App\Models;
use App\Models\SubTask;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks'; 
    protected $fillable = ['title', 'status', 'order', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subtasks()
    {
        return $this->hasMany(SubTask::class);
    }
}