<?php

namespace App\Imports;

use App\Models\Sla;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SlaSheetImport implements ToModel, WithHeadingRow
{
    protected $sheetKey;

    public function __construct(string $sheetKey)
    {
        $this->sheetKey = $sheetKey;
    }

    public function model(array $row)
    {
        return new Sla([
            'site_id'               => $row['site_id'] ?? '',
            'nama_lokasi'           => $row['nama_lokasi'] ?? '',
            'snmp_modem'            => $row['snmp_uptime_modem'] ?? '0%',
            'snmp_router'           => $row['snmp_uptime_router'] ?? '0%',
            'snmp_ap1'              => $row['snmp_uptime_ap1'] ?? '0%',
            'snmp_ap2'              => $row['snmp_uptime_ap2'] ?? '0%',
            'rata_rata_perangkat'   => $this->parsePersen($row['rata_rata_perangkat'] ?? '0%'),
            'rata_rata_ap1_ap2'     => $this->parsePersen($row['rata_rata_ap1_ap2'] ?? '0%'),
            'uptime_zabbix'         => $row['uptime_zabbix'] ?? '0',
            'uptime_perhari'        => $row['uptime_perhari'] ?? '0 JAM',
            'uptime_perhari_menit'  => $this->parseMenit($row['uptime_perhari_menit'] ?? '0 MENIT'),
            'sheet'                 => $this->sheetKey,   // ← simpan label sheet
        ]);
    }

    private function parsePersen(string $value): float
    {
        return floatval(str_replace('%', '', $value));
    }

    private function parseMenit(string $value): int
    {
        return intval(preg_replace('/\D/', '', $value));
    }
}
