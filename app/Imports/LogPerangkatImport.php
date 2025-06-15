<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\LogPerangkat;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LogPerangkatImport implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] === 'SITE ID') return null; // Tetap skip header

        $siteId = $row[0] ?? 'UNKNOWN'; // Atau buat default

        
        $tanggal = null;

        if (is_numeric($row[3])) {
            $tanggal = Date::excelToDateTimeObject($row[3])->format('Y-m-d');
        } else {
            try {
                // Ini penting: ganti ke d/m/Y
                $tanggal = Carbon::createFromFormat('d/m/Y', trim($row[3]))->format('Y-m-d');
            } catch (\Exception $e) {
                $tanggal = null; // Bisa log error untuk debug
            }
        }

        return new LogPerangkat([
            'site_id' => $row[0],
            'nama' => $row[1],
            'perangkat' => $row[2],
            'tanggal_pergantian' => $tanggal,
            'sn_lama' => $row[4],
            'sn_baru' => $row[5],
            'keterangan' => $row[6],
        ]);
    }
}
