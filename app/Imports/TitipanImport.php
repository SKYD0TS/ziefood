<?php

namespace App\Imports;

use App\Models\Titipan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TitipanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Titipan([
            'jenis_id' => auth()->user()->jenis_id,
            'nama_produk' => $row['nama_produk'],
            'nama_supplier' => $row['nama_supplier'],
            'harga_beli' => $row['harga_beli'],
            'harga_jual' => $row['harga_jual'],
            'stok' => $row['stok']
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
