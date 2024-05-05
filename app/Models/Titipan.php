<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titipan extends Model
{
    use HasFactory;
    protected $table ='titipans';
    protected $fillable = ['kategori_id', 'nama_produk', 'nama_supplier', 'harga_beli','harga_jual', 'stok'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
    public function historyTitipan()
    {
        return $this->hasMany(Titipan::class, 'id_titipan');
    }

}
