<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'kategori', 'lokasi_rak', 'gambar', 'status'
    ];
}
