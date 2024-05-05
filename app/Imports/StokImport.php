<?php

namespace App\Imports;

use App\Models\Menu;
use App\Models\Stok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StokImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
    //  * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $menu = Menu::find($row['menu_id']);

        $stok = Stok::find($menu->stok_id);
        $stok->jumlah = $row['stok'];
        $stok->save();
            // 'jumlah' => $row['stok'],
            // 'menu_id' => $row['stok'],
    }

    public function headingRow(): int
    {
        return 3;
    }
}
