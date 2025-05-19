<?php
namespace App\Http\Controllers;

use App\Models\M_peminjaman;
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
    
}
