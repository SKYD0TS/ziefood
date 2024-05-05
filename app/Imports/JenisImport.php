<?php

namespace App\Imports;

use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JenisImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
    //  * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Jenis([
            'nama_jenis' => $row['jenis'],
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
