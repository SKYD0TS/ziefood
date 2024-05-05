<?php

namespace App\Imports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\ToModel;

class PemesananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pemesanan([
            //
        ]);
    }
}
