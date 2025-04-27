<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_denda;
use App\Models\M_pengembalian;

class C_denda extends Controller
{
    public function index()
    {
        $denda = M_denda::with('pengembalian.peminjaman.buku')->get();
        $pengembalian = M_pengembalian::with('peminjaman.buku')->get();

        return view('admin.v_denda', compact('denda', 'pengembalian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengembalian' => 'required',
            'total_denda' => 'required|numeric',
            'sisa_denda' => 'required|numeric',
            'status_pembayaran' => 'required',
        ]);

        M_denda::create($request->all());

        return redirect()->back()->with('success', 'Data denda berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengembalian' => 'required',
            'total_denda' => 'required|numeric',
            'sisa_denda' => 'required|numeric',
            'status_pembayaran' => 'required',
        ]);

        M_denda::findOrFail($id)->update($request->all());

        return redirect()->back()->with('success', 'Data denda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        M_denda::destroy($id);
        return redirect()->back()->with('success', 'Data denda berhasil dihapus.');
    }
}
