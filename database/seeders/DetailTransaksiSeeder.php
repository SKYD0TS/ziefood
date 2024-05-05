<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DetailTransaksi::factory()->count(200)->create();
        $transaksis = Transaksi::all();
        foreach($transaksis as $transaksi){
            if ($transaksi->detailTransaksi->isEmpty()) {
                // If there are no detail transactions, delete the transaction
                $transaksi->delete();
            }
        }
    }
}
