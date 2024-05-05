<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $fillable = ['nama_kategori', 'jenis_id'];

    public function kategori(): HasMany
    {
        return $this->hasMany(Kategori::class, 'kategori_id', 'id');
    }

    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class, 'kategori_id', 'id');
    }
    public function titipan(): HasMany
    {
        return $this->hasMany(Titipan::class);
    }
}
