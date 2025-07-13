<?php
namespace App\Http\Controllers;

use App\Models\M_pengembalian;
use App\Models\M_peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class C_pengembalian extends Controller
{
    public function index()
    {
        $pengembalian = M_pengembalian::with('peminjaman.buku')->get();
        $peminjaman = M_peminjaman::where('status', 'aktif')->get();

        return view('admin.v_pengembalian', compact('pengembalian', 'peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'tanggal_kembali' => 'required|date',
            'kondisi_buku' => 'required|in:baik,rusak,hilang',
        ]);

        $status_pengembalian = match ($request->kondisi_buku) {
            'rusak' => 'rusak',
            'hilang' => 'hilang',
            default => 'selesai',
        };

        $status_buku = match ($request->kondisi_buku) {
            'baik' => 'baik',
            'rusak' => 'rusak',
            'hilang' => 'hilang',
            default => 'tersedia',
        };

        $pengembalian = M_pengembalian::create([
            'id_peminjaman' => $request->id_peminjaman,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_buku' => $request->kondisi_buku,
            'status_pengembalian' => $status_pengembalian,
        ]);

        // update status peminjaman jadi selesai
        $pengembalian->peminjaman->update(['status' => 'selesai']);

        if ($status_buku === 'hilang') {
            $pengembalian->peminjaman->buku->update(['status' => 'hilang']); 
        }else{
            $pengembalian->peminjaman->buku->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with('success', 'Pengembalian berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $pengembalian = M_pengembalian::findOrFail($id);
        $pengembalian->peminjaman->update(['status' => 'aktif']);
        $pengembalian->peminjaman->buku->update(['status' => 'dipinjam']);
        $pengembalian->delete();

        return redirect()->back()->with('success', 'Data pengembalian berhasil dihapus.');
    }

    public function kirim()
    {
        $apiKey = env('FONNTE_API_KEY');

        $tomorrow = Carbon::tomorrow();
        
        $peminjamans = M_peminjaman::where('tanggal_jatuh_tempo', $tomorrow)
                        ->where('status', 'aktif')
                        ->get();
        
        foreach ($peminjamans as $pinjam) {
            $siswa = $pinjam->siswa;
            $buku = $pinjam->buku;
            
            foreach ($siswa as $user) {
                $nomor = $user->kontak;

                if (!$nomor) continue;

                $pesan = "Halo {$user->name}, ini pengingat dari perpustakaan. Buku dengan judul '{$buku->judul}' jatuh tempo besok tanggal {$pinjam->tanggal_jatuh_tempo}. Mohon segera dikembalikan tepat waktu. Terima kasih!";

                $response = Http::withHeaders([
                    'Authorization' => $apiKey, 
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomor,                  
                    'message' => $pesan,                 
                    'typing' => false,                   
                    'countryCode' => '62',               
                ]);

                // Log response untuk debugging
                // Log::info('Nomor : '.$nomor.'| Pesan yang akan dikirim: ' . $pesan);
                // Log::info('Response API Body: ' . $response->body());
                // Log::info('Response API Status Code: ' . $response->status());                
                // Cek jika ada error
                if ($response->failed()) {
                    // Log::error('Error mengirim pesan ke ' . $nomor . ': ' . $response->body());
                    return redirect()->back()->with('error', 'Ada pesan yang tidak terkirim.');
                } else {
                    return redirect()->back()->with('success', 'Berhasil mengirim pesan pengingat.');
                    // $this->info('Pesan terkirim ke ' . $nomor);
                }
            }
        }
    }
}
