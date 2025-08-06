<?php

namespace App\Imports;

use App\Models\Sparetracker;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;

class LogTrackerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Debug baris per baris, bisa dimatikan jika sudah tidak diperlukan
        // dd($row);

        // Update SN ke datasite jika ditemukan
        if (isset($row['lokasi_realtime'], $row['jenis'], $row['sn_serial_number'])) {
            $jenis = strtolower(trim($row['jenis']));
            $snBaru = $row['sn_serial_number'];
            $namaLokasi = trim($row['lokasi_realtime']);

            switch ($jenis) {
                case 'modem':
                    DB::table('datasite')->where('sitename', $namaLokasi)->update(['sn_modem' => $snBaru]);
                    break;
                case 'router':
                    DB::table('datasite')->where('sitename', $namaLokasi)->update(['sn_router' => $snBaru]);
                    break;
                case 'switch':
                    DB::table('datasite')->where('sitename', $namaLokasi)->update(['sn_switch' => $snBaru]);
                    break;
                // Tambahkan jenis lainnya di sini jika perlu
            }
        }


        return new Sparetracker([
            'sn' => $row['sn_(serial_number)']
                    ?? $row['sn'] 
                    ?? $row['serial_number'] 
                    ?? $row['sn_serial_number']
                    ?? null,
            'nama_perangkat' => $row['nama_perangkat'] ?? null,
            'jenis' => $row['jenis'] ?? null,
            'type' => $row['type'] ?? null,
            'kondisi' => $row['kondisi'] ?? null,
            'pengadaan_by' => $row['pengadaan_by'] ?? null,
            'lokasi_asal' => $row['lokasi_asal'] ?? null,
            'lokasi' => $row['lokasi'] ?? null,
            'bulan_masuk' => $row['bulan_masuk'] ?? null,
            'tanggal_masuk' => $this->excelDateToCarbon($row['tanggal_masuk'] ?? null),
            'status_penggunaan_sparepart' => $row['status_penggunaan_sparepart'] ?? null,
            'lokasi_realtime' => $row['lokasi_realtime'] ?? null,
            'kabupaten' => $row['kabupaten'] ?? null,
            'bulan_keluar' => $row['bulan_keluar'] ?? null,
            'tanggal_keluar' => $this->excelDateToCarbon($row['tanggal_keluar'] ?? null),
            'layanan_ai' => $row['layanan_ai'] ?? null,
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }

    // Fungsi bantu konversi Excel date ke format Y-m-d
    private function excelDateToCarbon($excelDate)
    {
        try {
            return $excelDate ? Date::excelToDateTimeObject($excelDate)->format('Y-m-d') : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
