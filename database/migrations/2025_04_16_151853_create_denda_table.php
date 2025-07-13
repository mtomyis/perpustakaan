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
        Schema::create('denda', function (Blueprint $table) {
            $table->id('id_denda');
            $table->unsignedBigInteger('id_pengembalian');
            // $table->decimal('total_denda', 10, 2);
            // $table->decimal('sisa_denda', 10, 2);
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas']);
            $table->timestamps();
        
            $table->foreign('id_pengembalian')->references('id_pengembalian')->on('pengembalian')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('denda');
    }
};
