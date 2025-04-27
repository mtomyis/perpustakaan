<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_denda extends Model
{
    use HasFactory;

    protected $table = 'denda';
    protected $primaryKey = 'id_denda';

    protected $fillable = [
        'id_pengembalian',
        'total_denda',
        'sisa_denda',
        'status_pembayaran',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(M_pengembalian::class, 'id_pengembalian', 'id_pengembalian');
    }
}
