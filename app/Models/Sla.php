<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sla extends Model
{
    protected $table = 'slas'; // Pastikan nama tabel ini sesuai dengan database kamu

    protected $fillable = [
        'site_id',
        'nama_lokasi',
        'snmp_modem',
        'snmp_router',
        'snmp_ap1',
        'snmp_ap2',
        'rata_rata_seluruh_perangkat',
        'rata_rata_ap1_ap2',
        'uptime_zabbix',
        'uptime_perhari',
        'uptime_perhari_menit',
        'sheet',
    ];
}
