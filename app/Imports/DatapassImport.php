<?php

namespace App\Imports;

use App\Models\Datapass;
use Maatwebsite\Excel\Concerns\ToModel;

class DatapassImport implements ToModel
{
    public function model(array $row)
    {
        return new Datapass([
            'site_id' => $row[0],
            'nama_lokasi' => $row[1],
            'kabupaten' => $row[2],
            'adop' => $row[3],
            'pass_ap1' => $row[4],
            'pass_ap2' => $row[5],
        ]);
    }
}
