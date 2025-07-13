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
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->enum('kategori', ['cerita', 'majalah', 'pengetahuan', 'pembelajaran', 'seni', 'hukum', 'sains']);
            $table->enum('lokasi_rak', [1, 2, 3, 4, 5, 6, 7]);
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'dipinjam','rusak', 'hilang']);
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
        Schema::dropIfExists('buku');
    }
};
