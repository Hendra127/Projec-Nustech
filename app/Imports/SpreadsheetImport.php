<?php
namespace App\Imports;

use App\Models\Datasite;
use Maatwebsite\Excel\Concerns\ToModel;

class SpreadsheetImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Datasite([
            'idsite'              => $row[0],
            'sitename'            => $row[1],
            'tipe'                => $row[2],
            'batch'               => $row[3],
            'latitude'            => $row[4],
            'longitude'           => $row[5],
            'provinsi'            => $row[6],
            'kab'                 => $row[7],
            'kecamatan'           => $row[8],
            'kelurahan'           => $row[9],
            'alamat_lokasi'       => $row[10],
            'nama_pic'            => $row[11],
            'nomor_pic'           => $row[12],
            'sumber_listrik'      => $row[13],
            'gateway_area'        => $row[14],
            'beam'                => $row[15],
            'hub'                 => $row[16],
            'kodefikasi'          => $row[17],
            'sn_antena'           => $row[18],
            'sn_modem'            => $row[19],
            'sn_router'           => $row[20],
            'sn_ap1'              => $row[21],
            'sn_ap2'              => $row[22],
            'sn_tranciever'       => $row[23],
            'sn_stabilizer'       => $row[24],
            'sn_rak'              => $row[25],
            'ip_modem'            => $row[26],
            'ip_router'           => $row[27],
            'ip_ap1'              => $row[28],
            'ip_ap2'              => $row[29],
            'expected_sqf'        => $row[30],
        ]);
    }
}
