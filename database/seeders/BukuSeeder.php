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
                'kategori' => 'cerita',
                'lokasi_rak' => '1',
                'gambar' => 'laskar_pelangi.jpg',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2009,
                'kategori' => 'cerita',
                'lokasi_rak' => '2',
                'gambar' => 'negeri_5_menara.jpg',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2014,
                'kategori' => 'pengetahuan',
                'lokasi_rak' => '3',
                'gambar' => 'bumi.jpg',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Republika',
                'tahun_terbit' => 2004,
                'kategori' => 'cerita',
                'lokasi_rak' => '4',
                'gambar' => 'ayat_ayat_cinta.jpg',
                'status' => 'tersedia'
            ],
            [
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => 2014,
                'kategori' => 'cerita',
                'lokasi_rak' => '5',
                'gambar' => 'dilan_1990.jpg',
                'status' => 'tersedia'
            ]
        ]);
    }
}
