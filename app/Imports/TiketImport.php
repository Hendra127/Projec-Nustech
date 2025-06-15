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
            // Normalisasi nama kolom agar aman
            $data = collect($row)->mapWithKeys(function ($value, $key) {
                $normalizedKey = strtolower(trim(str_replace([' ', '/', '\\'], '_', $key)));
                return [$normalizedKey => $value];
            });

            $namaSite = $data['nama_site'] ?? null;
            if (!$namaSite) continue;

            $tanggal_rekap = $this->convertToDate($data['tanggal_rekap'] ?? null);
            $tanggal_close = $this->convertToDate($data['tanggal_close'] ?? null);

            // Hitung durasi setelah tanggal rekap dikonversi
           $durasi = $tanggal_rekap
            ? Carbon::parse($tanggal_rekap)->diffInDays(Carbon::today())
            : null;

            // Default bulan_close
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

        // Jika format Excel numeric date
        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Jika format teks, coba format m/d/Y
        try {
            return Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            // Jika gagal, coba parse default
            try {
                return Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }
    }
}
