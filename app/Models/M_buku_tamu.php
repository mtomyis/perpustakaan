<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_buku_tamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamu';
    protected $primaryKey = 'id_tamu';
    protected $fillable = ['nama_pengunjung', 'instansi', 'tanggal_kunjungan', 'jam_masuk', 'keperluan'];
}
