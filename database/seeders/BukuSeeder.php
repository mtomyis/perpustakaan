<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'jumlah' => 10,
                'lokasi_rak' => 'A1',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2009,
                'jumlah' => 8,
                'lokasi_rak' => 'A2',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2014,
                'jumlah' => 7,
                'lokasi_rak' => 'A3',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Republika',
                'tahun_terbit' => 2004,
                'jumlah' => 5,
                'lokasi_rak' => 'A4',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => 2014,
                'jumlah' => 6,
                'lokasi_rak' => 'A5',
                'status' => 'tersedia'
            ]
        ]);
    }
}
