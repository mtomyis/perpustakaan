<?php
namespace App\Http\Controllers;

use App\Models\M_peminjaman;
use Illuminate\Http\Request;

class C_laporan extends Controller
{
    public function index()
    {
        $peminjaman = M_peminjaman::with([
            'buku',
            'siswa',
            'pengembalian'
        ])->get();
        return view('admin.v_laporan', compact('peminjaman'));

    }
}
