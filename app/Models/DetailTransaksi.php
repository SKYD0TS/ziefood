<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    // protected $table = 'detail_transaksi';
    protected $fillable = ['id_transaksi', 'id_menu', 'id_titipan', 'jumlah', 'subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
    public function titipan()
    {
        return $this->belongsTo(Titipan::class, 'id_titipan');
    }
}
