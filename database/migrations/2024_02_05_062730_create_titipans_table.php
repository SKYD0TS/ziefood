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
        Schema::create('titipans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->References('id')->on('kategoris')->cascadeOnDelete();
            $table->string('nama_produk');
            $table->string('nama_supplier');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->double('stok');
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
        Schema::dropIfExists('titipans');
    }
};
