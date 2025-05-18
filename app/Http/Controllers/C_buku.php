<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_buku;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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
            'kategori'       => 'required',
            'lokasi_rak'   => 'required|string|max:50',
            'status'       => 'required|in:tersedia,rusak,hilang',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $namaFile = time(). '.' . $ext;
            $path = $file->storeAs('public/buku', $namaFile);
            $data['gambar'] = $namaFile;
        }

        M_buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori'       => 'required',
            'lokasi_rak'   => 'required|string|max:50',
            'status'       => 'required|in:tersedia,rusak,hilang',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buku = M_buku::findOrFail($id);
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($buku->gambar && Storage::exists('public/buku/' . $buku->gambar)) {
                Storage::delete('public/buku/' . $buku->gambar);
            }

            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $namaFile = time(). '.' . $ext;
            $path = $file->storeAs('public/buku', $namaFile);
            $data['gambar'] = $namaFile;
        }

        $buku->update($data);   

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = M_buku::findOrFail($id);
        if ($buku->gambar && Storage::exists('public/buku/' . $buku->gambar)) {
            Storage::delete('public/buku/' . $buku->gambar);
        }
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
