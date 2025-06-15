<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'file_upload'; // sesuai dengan nama tabel kamu

    protected $fillable = [
        'nama_file',
        'path',
    ];
}