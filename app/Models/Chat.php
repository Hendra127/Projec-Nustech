<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'sender_name',
        'sender_type',
        'message',
        'reply_to_name',
        'reply_to_message'
    ];
}