<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\M_buku;
use App\Models\M_peminjaman;
use App\Models\M_pengembalian;

class C_dashboard extends Controller
{
    public function admin()
    {
        $katalog_buku = M_buku::count();
        $buku_dipinjam = M_peminjaman::where('status', 'aktif')->count();
        $pengembalian = M_pengembalian::count();
        $yang_meminjam = DB::table('detail_peminjaman')->distinct('id_user')->count('id_user');

        return view('admin.v_dashboard', 
            compact(
            'katalog_buku',
            'buku_dipinjam',
            'pengembalian',
            'yang_meminjam'
            )
        );
    }

    public function kepala()
    {
        $katalog_buku = M_buku::count();
        $buku_dipinjam = M_peminjaman::where('status', 'aktif')->count();
        $pengembalian = M_pengembalian::count();
        $yang_meminjam = DB::table('detail_peminjaman')->distinct('id_user')->count('id_user');

        return view('kepala.v_dashboard', 
            compact(
            'katalog_buku',
            'buku_dipinjam',
            'pengembalian',
            'yang_meminjam'
            )
        );
    }

    public function siswa()
    {
        $katalog_buku = M_buku::count();
        $buku_dipinjam = M_peminjaman::where('status', 'aktif')->count();
        $pengembalian = M_pengembalian::count();
        $yang_meminjam = DB::table('detail_peminjaman')->distinct('id_user')->count('id_user');

        return view('siswa.v_dashboard', 
            compact(
            'katalog_buku',
            'buku_dipinjam',
            'pengembalian',
            'yang_meminjam'
            )
        );
    }
}