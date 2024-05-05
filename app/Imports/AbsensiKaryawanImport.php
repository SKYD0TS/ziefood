<?php

namespace App\Imports;

use App\Models\AbsensiKaryawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class absensiKaryawanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
    //  * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new absensiKaryawan([
            'namaKaryawan' => $row['nama_karyawan'],
            'tanggalMasuk' => $row['tanggal_masuk'],
            'waktuMasuk' => $row['waktu_masuk'],
            'status' => $row['status'],
            'waktuKeluar' => $row['waktu_keluar']
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
