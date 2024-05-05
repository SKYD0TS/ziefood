<?php

namespace App\Imports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Kategori([
            'nama_kategori' => $row['kategori'],
            'jenis_id' => $row['jenis_id']
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
