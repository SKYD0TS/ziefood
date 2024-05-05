<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stoks';
    protected $fillable = ['menu_id', 'jumlah'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'stok_id',);
    }
}
