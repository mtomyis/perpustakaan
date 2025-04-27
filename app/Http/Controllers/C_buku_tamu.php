<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_buku_tamu;

class C_buku_tamu extends Controller
{
    // Tampilkan semua data buku tamu
    public function index()
    {
        $bukuTamu = M_buku_tamu::orderBy('tanggal_kunjungan', 'desc')->get();
        return view('admin.v_buku_tamu', compact('bukuTamu'));
    }

    // Simpan data baru buku tamu
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengunjung' => 'required|string|max:100',
            'tanggal_kunjungan' => 'required|date',
            'keperluan' => 'required|string',
        ]);

        M_buku_tamu::create($request->all());

        return redirect()->route('buku-tamu.index')->with('success', 'Data buku tamu berhasil ditambahkan.');
    }

    // Update data buku tamu
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengunjung' => 'required|string|max:100',
            'tanggal_kunjungan' => 'required|date',
            'keperluan' => 'required|string',
        ]);

        $tamu = M_buku_tamu::findOrFail($id);
        $tamu->update($request->all());

        return redirect()->route('buku-tamu.index')->with('success', 'Data buku tamu berhasil diperbarui.');
    }

    // Hapus data buku tamu
    public function destroy($id)
    {
        $tamu = M_buku_tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('buku-tamu.index')->with('success', 'Data buku tamu berhasil dihapus.');
    }
}
