<?php

namespace App\Imports;

use App\Models\NewProject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewProjectImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new NewProject([
            'site_id'        => $row['site_id'],
            'sitename'       => $row['sitename'],
            'tipe'           => $row['tipe'],
            'batch'          => $row['batch'],
            'latitude'       => $row['latitude'],
            'longitude'      => $row['longitude'],
            'provinsi'       => $row['provinsi'],
            'kabupaten'      => $row['kabupaten'],
            'kecamatan'      => $row['kecamatan'],
            'kelurahan'      => $row['kelurahan'],
            'alamat'         => $row['alamat'],
            'nama_pic'       => $row['nama_pic'],
            'nomor_pic'      => $row['nomor_pic'],
            'sumber_listrik' => $row['sumber_listrik'],
            'gateway_area'   => $row['gateway_area'],
            'beam'           => $row['beam'],
            'hub'            => $row['hub'],
            'kodefikasi'     => $row['kodefikasi'],
            'sn_antena'      => $row['sn_antena'],
            'sn_modem'       => $row['sn_modem'],
            'sn_router'      => $row['sn_router'],
            'sn_ap1'         => $row['sn_ap1'],
            'sn_ap2'         => $row['sn_ap2'],
            'sn_tranciever'  => $row['sn_tranciever'],
            'sn_stabilizer'  => $row['sn_stabilizer'],
            'sn_rak'         => $row['sn_rak'],
            'ip_modem'       => $row['ip_modem'],
            'ip_router'      => $row['ip_router'],
            'ip_ap1'         => $row['ip_ap1'],
            'ip_ap2'         => $row['ip_ap2'],
            'expected_sqf'   => $row['expected_sqf'],
        ]);
    }
}
