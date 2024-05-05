<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $pelanggans = [
            [
                'nama' => 'Pelanggan umum',
                'email' => '-',
                'no_telp' => '-',
                'alamat' => '-',
            ],
        ];
        foreach ($pelanggans as $key => $value) {
            Pelanggan::create($value);
        }
        Pelanggan::factory()->count(5)->create();
    }
}
