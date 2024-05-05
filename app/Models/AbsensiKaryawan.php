<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKaryawan extends Model
{
    use HasFactory;
    
    protected $table = 'absensi_karyawans';
    protected $fillable = ['namaKaryawan', 'tanggalMasuk', 'waktuMasuk', 'status', 'waktuKeluar'];

}
