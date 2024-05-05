<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DetailTransaksi;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Stok;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $makanan = Jenis::create([
            'nama_jenis' => 'Minuman'
        ]);
        
        $minuman = Jenis::create([
            'nama_jenis' => 'Makanan'
        ]);
        $minuman = Jenis::create([
            'nama_jenis' => 'Camilan'
        ]);
        $this->call(PelangganSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(StokSeeder::class);
        $this->call(TransaksiSeeder::class);
        $this->call(DetailTransaksiSeeder::class);

        


    }
}
