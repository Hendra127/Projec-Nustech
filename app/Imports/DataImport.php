<?php

namespace App\Imports;

use App\Models\Datasite;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
{
    $row = $row->toArray();

    // Ubah semua key ke lowercase dulu
    $row = array_change_key_case($row, CASE_LOWER);

    // Normalisasi key ke lowercase dan hapus spasi
    $normalizedRow = [];
    foreach ($row as $key => $value) {
        $normalizedKey = strtolower(trim(str_replace([' ', '/', '\\'], '_', $key)));
        $normalizedRow[$normalizedKey] = $value;
    }

    // Konversi latitude & longitude ke float dengan 6 digit desimal
    $latitude = isset($normalizedRow['latitude']) ? (float) str_replace(',', '.', $normalizedRow['latitude']) : null;
    $longitude = isset($normalizedRow['longitude']) ? (float) str_replace(',', '.', $normalizedRow['longitude']) : null;

    // Pembulatan ke 6 digit desimal
    $latitude = $latitude !== null ? round($latitude, 6) : null;
    $longitude = $longitude !== null ? round($longitude, 6) : null;

    // Memastikan nilai latitude dan longitude berada dalam rentang yang valid
    if ($latitude !== null && ($latitude < -90 || $latitude > 90)) {
        $latitude = null; // Set ke null jika tidak valid
    }
    if ($longitude !== null && ($longitude < -180 || $longitude > 180)) {
        $longitude = null; // Set ke null jika tidak valid
    }

    // Pastikan site_id tidak null
    $siteId = $normalizedRow['site_id'] ?? $normalizedRow['idsite'] ?? null;
    if (!$siteId) {
        // Jika site_id tidak ada, tentukan nilai default atau abaikan baris ini
        // Misalnya, bisa mengabaikan baris ini jika site_id tidak ada
        return;  // Mengabaikan baris ini
    }

    Datasite::create([
        'site_id'         => $siteId,
        'sitename'        => $normalizedRow['nama_lokasi'] ?? $normalizedRow['sitename'] ?? null,
        'tipe'            => $normalizedRow['tipe'] ?? null,
        'batch'           => $normalizedRow['batch'] ?? null,
        'latitude'        => $latitude,
        'longitude'       => $longitude,
        'provinsi'        => $normalizedRow['provinsi'] ?? null,
        'kab'             => $normalizedRow['kabupaten'] ?? $normalizedRow['kab'] ?? null,
        'kecamatan' => $normalizedRow['kecamatan'] 
            ?? $normalizedRow['KACAMATAN'] 
            ?? null,

        'kelurahan' => $normalizedRow['kelurahan'] 
            ?? $normalizedRow['KELURAHAN'] 
            ?? null,
        'alamat_lokasi'   => $normalizedRow['alamat_lokasi'] ?? null,
        'nama_pic'        => $normalizedRow['nama_pic_lokasi'] ?? null,
        'nomor_pic'       => $normalizedRow['nomor_pic_lokasi'] ?? null,
        'sumber_listrik'  => $normalizedRow['sumber_listrik_utama'] ?? null,
        'gateway_area'    => $normalizedRow['gateway_area'] ?? null,
        'beam'            => $normalizedRow['beam'] ?? null,
        'hub'             => $normalizedRow['hub'] ?? null,
        'kodefikasi'      => $normalizedRow['kodefikasi'] ?? null,
        'sn_antena'       => $normalizedRow['sn_antena'] ?? null,
        'sn_modem'        => $normalizedRow['sn_modem_ht3210'] ?? null,
        'sn_router'       => $normalizedRow['sn_router_450gx4'] ?? null,
        'sn_ap1'          => $normalizedRow['sn_ap1_vt_601'] ?? null,
        'sn_ap2'          => $normalizedRow['sn_ap2_vt_601'] ?? null,
        'sn_tranciever'   => $normalizedRow['sn_tranciever'] ?? null,
        'sn_stabilizer'   => $normalizedRow['sn_stabilizer'] ?? null,
        'sn_rak'          => $normalizedRow['sn_rak'] ?? null,
        'ip_modem'        => $normalizedRow['ip_modem'] ?? null,
        'ip_router'       => $normalizedRow['ip_router'] ?? null,
        'ip_ap1'          => $normalizedRow['ip_ap_1'] ?? null,
        'ip_ap2'          => $normalizedRow['ip_ap_2'] ?? null,
        'expected_sqf'    => $normalizedRow['expected_sqf'] ?? null,
    ]);
}
}