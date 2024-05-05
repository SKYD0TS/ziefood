<?php

namespace App\Imports;

use App\Models\Menu;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
    //  * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $stok = Stok::find($row['stok_id']);
        $newStok = 
        $newMenu = [
            'kategori_id' => $row['kategori_id'],
            'nama_menu' => $row['menu'],
            'harga' => $row['harga'],
            'image' => $row['image'],
            'deskripsi' => $row['deskripsi']
        ];
        
        if($stok){
            $stok->update(['jumlah'=>0]);
        $newMenu['stok_id'] = $row['stok_id'];
        }else{
            $newStok = Stok::create(['jumlah'=>0]);
            $newMenu['stok_id'] = $newStok->id;
        }
        return new Menu($newMenu);
    }
    public function headingRow(): int
    {
        return 3;
    }
}
