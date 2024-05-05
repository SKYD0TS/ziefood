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
        Schema::create('history_titipan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->References('id')->on('transaksis')->cascadeOnDelete();
            $table->foreignId('id_titipan')->references('id')->on('titipans')->cascadeOnDelete();
            $table->string('nama_supplier');
            $table->unsignedInteger('terjual');
            $table->double('harga');
            $table->double('subtotal');
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
        Schema::dropIfExists('detail_transaksis');
    }
};
