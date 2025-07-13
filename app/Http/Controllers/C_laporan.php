<?php
namespace App\Http\Controllers;

use App\Models\M_peminjaman;
use App\Models\M_buku_tamu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function index_tamu()
    {
        $bukuTamu = M_buku_tamu::orderBy('tanggal_kunjungan', 'desc')->get();
        return view('admin.v_laporan_tamu', compact('bukuTamu'));
    }

    public function cetak(Request $request)
    {
        $peminjaman = M_peminjaman::with([
            'buku',
            'siswa',
            'pengembalian'
        ])->get();
        $pdf = Pdf::loadView('v_cetak_laporan', compact('peminjaman'));
        // return $pdf->download('laporan-transaksi.pdf');
        return $pdf->stream('laporan-transaksi.pdf');
    }

    public function cetak_tamu(Request $request)
    {
        $bukuTamu = M_buku_tamu::orderBy('tanggal_kunjungan', 'desc')->get();
        $pdf = Pdf::loadView('v_cetak_laporan_tamu', compact('bukuTamu'));
        // return $pdf->download('laporan-buku-tamu.pdf');
        return $pdf->stream('laporan-buku-tamu.pdf');
    }
    
}
