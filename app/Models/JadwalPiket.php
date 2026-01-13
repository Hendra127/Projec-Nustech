<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket'; // ✅ Tambahkan baris ini

    protected $fillable = ['nama', 'tanggal', 'shift'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}