<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\M_peminjaman;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

class KirimPengingatPeminjaman extends Command
{
    protected $signature = 'pengingat:kirim';
    protected $description = 'Mengirim pesan WhatsApp pengingat pengembalian buku ke siswa-siswa H-1';

    public function handle()
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

                $pesan = "Halo {$user->name}, ini pengingat dari perpustakaan. Buku dengan judul '{$buku->judul}' jatuh tempo besok. Mohon segera dikembalikan tepat waktu. Terima kasih!";

                $response = Http::withHeaders([
                    'Authorization' => $apiKey, 
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomor,                  
                    'message' => $pesan,                 
                    'typing' => false,                   
                    'countryCode' => '62',               
                ]);

                // Log response untuk debugging
                Log::info('Nomor : '.$nomor.'| Pesan yang akan dikirim: ' . $pesan);
                Log::info('Response API Body: ' . $response->body());
                Log::info('Response API Status Code: ' . $response->status());                
                // Cek jika ada error
                if ($response->failed()) {
                    Log::error('Error mengirim pesan ke ' . $nomor . ': ' . $response->body());
                } else {
                    $this->info('Pesan terkirim ke ' . $nomor);
                }
            }
        }

        return Command::SUCCESS;
    }
}
