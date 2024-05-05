<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('namaKaryawan');
            $table->date('tanggalMasuk');
            $table->time('waktuMasuk');
            $table->string('status')->default('active');
            $table->time('waktuKeluar')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi_karyawans');
    }
}
