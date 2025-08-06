<?php

namespace App\Imports;

use App\Models\PmLiberta;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PmLibertaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PmLiberta([
            'site_id'        => $row['site_id'] ?? null,
            'nama_lokasi'    => $row['nama_lokasi'] ?? null,
            'provinsi'       => $row['provinsi'] ?? null,
            'kabupaten_kota' => $row['kabupaten_kota'] ?? null,
            'pic_ce'         => $row['pic_ce'] ?? null,
            'month'          => $row['month'] ?? null,
            'date'           => $this->transformDate($row['date'] ?? null),
            'status'         => $row['status'] ?? null,
            'week'           => $row['week'] ?? null,
            'kategori'       => $row['kategori'] ?? null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    /**
     * Mengubah nilai tanggal dari format Excel serial atau string ke Y-m-d
     */
    private function transformDate($value)
    {
        if (!$value) return null;

        if (is_numeric($value)) {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
