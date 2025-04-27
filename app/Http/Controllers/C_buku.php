<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_buku;

class C_buku extends Controller
{
    public function index()
    {
        $buku = M_buku::all();
        return view('admin.v_buku', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah'       => 'required|integer|min:0',
            'lokasi_rak'   => 'required|string|max:50',
            'status'       => 'required|in:tersedia,rusak,hilang',
        ]);

        M_buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah'       => 'required|integer|min:0',
            'lokasi_rak'   => 'required|string|max:50',
            'status'       => 'required|in:tersedia,rusak,hilang',
        ]);

        $buku = M_buku::findOrFail($id);
        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = M_buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
