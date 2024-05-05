<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'nama_kategori' => 'Minuman',
                'jenis_id'=>'1'
            ],
            [
                'nama_kategori' => 'Makanan',
                'jenis_id'=>'2'
            ],
            [
                'nama_kategori' => 'Camilan',
                'jenis_id'=>'3'
            ]
            ];
        foreach ($kategori as $key => $value) {
            Kategori::create($value);
        }
    }
}
