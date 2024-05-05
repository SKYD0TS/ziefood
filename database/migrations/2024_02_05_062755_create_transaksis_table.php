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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('id_pelanggan')->nullable()->references('id')->on('pelanggans')->cascadeOnDelete();
            $table->double('total_harga');
            $table->enum('metode_pembayaran', ['cash', 'qris', 'transfer']);
            $table->string('keterangan')->nullable(true);
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
        Schema::dropIfExists('transaksis');
    }
};
