<?php

namespace App\Imports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\ToModel;

class TrackingImport implements ToModel
{
    public function model(array $row)
    {
        return new Tracking([
            'nama_perangkat' => $row[0],
            'jenis' => $row[1],
            'tipe' => $row[2],
            'sn' => $row[3],
            'kondisi' => $row[4],
            'lokasi_awal' => $row[5],
            'kab_awal' => $row[6],
            'lokasi_realtime' => $row[7],
            'kab_realtime' => $row[8],
            'layanan_ai' => $row[9],
            'bulan_masuk' => $row[10],
            'tanggal_masuk' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]),
            'bulan_keluar' => $row[12],
            'tanggal_keluar' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]),
            'keterangan' => $row[14],
        ]);
    }
}
