<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_buku', 'tanggal_pinjam', 'tanggal_jatuh_tempo',
        'jenis_peminjaman', 'status'
    ];

    public function buku()
    {
        return $this->belongsTo(M_buku::class, 'id_buku');
    }

    public function siswa()
    {
        return $this->belongsToMany(User::class, 'detail_peminjaman', 'id_peminjaman', 'id_user');
    }

    public function pengembalian()
    {
        return $this->hasOne(M_pengembalian::class, 'id_peminjaman');
    }       
}
