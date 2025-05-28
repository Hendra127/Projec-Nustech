<?php

namespace App\Imports;

use App\Models\Tiket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class TiketImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Normalisasi key
            $data = collect($row)->mapWithKeys(function ($value, $key) {
                $normalizedKey = strtolower(trim(str_replace([' ', '/', '\\'], '_', $key)));
                return [$normalizedKey => $value];
            });

            $namaSite = $data['nama_site'] ?? null;
            if (!$namaSite) continue;

            // Konversi durasi ke integer jika valid
            $durasi = is_numeric($data['durasi']) ? (int) $data['durasi'] : null;

            // Konversi tanggal rekap dan close
            $tanggal_rekap = $this->convertToDate($data['tanggal_rekap'] ?? null);
            $tanggal_close = $this->convertToDate($data['tanggal_close'] ?? null);

            // Tangani bulan_close agar tidak null
            $bulan_close = trim($data['bulan_close'] ?? '') ?: 'BELUM CLOSE';

            Tiket::updateOrCreate(
                ['nama_site' => $namaSite],
                [
                    'site_id'         => $data['site_id'] ?? null,
                    'nama_site'       => $data['nama_site'] ?? null,
                    'provinsi'        => $data['provinsi'] ?? null,
                    'kabupaten'       => $data['kabupaten'] ?? null,
                    'durasi'          => $durasi,
                    'kategori'        => $data['kategori'] ?? null,
                    'tanggal_rekap'   => $tanggal_rekap,
                    'bulan_open'      => $data['bulan_open'] ?? null,
                    'status_tiket'    => $data['status_tiket'] ?? null,
                    'kendala'         => $data['kendala'] ?? null,
                    'tanggal_close'   => $tanggal_close,
                    'bulan_close'     => $bulan_close,
                    'detail_problem'  => $data['detail_problem'] ?? null,
                ]
            );
        }
    }

    private function convertToDate($value)
    {
        if (!$value) return null;

        // Jika format Excel number
        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Jika string dan format sudah tanggal valid
        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
