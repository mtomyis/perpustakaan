<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $fillable = ['id_peminjaman', 'tanggal_kembali', 'kondisi_buku', 'status_pengembalian'];

    public function peminjaman()
    {
        return $this->belongsTo(M_peminjaman::class, 'id_peminjaman');
    }

    public function denda()
    {
        return $this->hasOne(M_denda::class, 'id_pengembalian');
    }
}
