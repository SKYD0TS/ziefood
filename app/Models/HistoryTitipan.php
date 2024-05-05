<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTitipan extends Model
{
    use HasFactory;

    protected $fillable = ['id_transaksi', 'id_titipan', 'jumlah', 'subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
    public function titipan()
    {
        return $this->belongsTo(Menu::class, 'id_titipan');
    }
}
