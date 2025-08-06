<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\LaporanPM;

class LaporanPMImport implements ToCollection
{

public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            // Skip row if tanggal_submit is empty or invalid
            if (empty($row[1]) || (is_string($row[1]) && strtotime($row[1]) === false)) {
                continue;
            }

            $tanggalSubmit = is_numeric($row[1])
                ? Date::excelToDateTimeObject($row[1])->format('Y-m-d')
                : date('Y-m-d', strtotime($row[1]));

            $laporanBAPM = !empty($row[7])
                ? (is_numeric($row[7]) ? Date::excelToDateTimeObject($row[7])->format('Y-m-d') : date('Y-m-d', strtotime($row[7])))
                : null;

            LaporanPM::create([
                'tanggal_submit'    => $tanggalSubmit,
                'site_id'           => $row[2] ?? null,
                'lokasi_site'       => $row[3] ?? null,
                'kabupaten_kota'    => $row[4] ?? null,
                'provinsi'          => $row[5] ?? null,
                'pm_bulan'          => $row[6] ?? null,
                'laporan_ba_pm'     => $laporanBAPM,
                'teknisi'           => isset($row[8]) && trim($row[8]) !== '' ? $row[8] : null,
                'masalah_kendala'   => $row[9] ?? null,
                'action'            => $row[10] ?? null,
                'ket_tambahan'      => $row[11] ?? null,
                'status_laporan'    => $row[12] ?? null,
            ]);
        }
    }
}