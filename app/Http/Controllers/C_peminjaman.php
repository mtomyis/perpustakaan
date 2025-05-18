<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\M_peminjaman;
use App\Models\M_buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_peminjaman extends Controller
{
    public function index()
    {
        $peminjaman = M_peminjaman::with(['buku', 'siswa'])->get();
        $buku = M_buku::where('status', 'tersedia')->get();
        if (Auth::user()->role == 'admin') {
            $siswa = User::where('role', 'siswa')->get();
        }else{
            $siswa = User::where('email', Auth::user()->email)->get();
        }
        
        return view('admin.v_peminjaman', compact('peminjaman', 'buku', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
            'jenis_peminjaman' => 'required|in:dibawa_pulang,di_perpustakaan',
            'siswa' => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $peminjaman = M_peminjaman::create([
                'id_buku' => $request->id_buku,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jenis_peminjaman' => $request->jenis_peminjaman,
                'status' => 'aktif',
            ]);

            $peminjaman->siswa()->attach($request->siswa);
            $peminjaman->buku->update(['status' => 'dipinjam']);
        });

        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
            'jenis_peminjaman' => 'required|in:dibawa_pulang,di_perpustakaan',
            'siswa' => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {
            $peminjaman = M_peminjaman::findOrFail($id);
            $peminjaman->update([
                // 'id_buku' => $request->id_buku,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jenis_peminjaman' => $request->jenis_peminjaman,
            ]);

            $peminjaman->siswa()->sync($request->siswa);
        });

        return redirect()->back()->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = M_peminjaman::findOrFail($id);
        $peminjaman->buku->update(['status' => 'tersedia']);
        $peminjaman->delete();


        return redirect()->back()->with('success', 'Peminjaman berhasil dihapus.');
    }
}
