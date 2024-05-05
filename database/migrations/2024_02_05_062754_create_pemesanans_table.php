<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->References('id')->on('menus')->cascadeOnDelete();
            $table->date('tanggal_pemesanan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('nama_pemesan');
            $table->integer('jumlah_pelanggan');
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
        Schema::dropIfExists('pemesanans');
    }
};
