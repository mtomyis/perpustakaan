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
        Schema::create('pembayaran_denda', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_denda');
            $table->date('tanggal_bayar');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->timestamps();
        
            $table->foreign('id_denda')->references('id_denda')->on('denda')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_denda');
    }
};
