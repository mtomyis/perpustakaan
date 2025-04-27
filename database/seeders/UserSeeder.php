<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@perpus.com',
            'password' => Hash::make('kepsek123'),
            'role' => 'kepala_sekolah'
        ]);

        User::create([
            'name' => 'M Tomy Iskandar',
            'email' => 'mtomyis@perpus.com',
            'password' => Hash::make('tomy123'),
            'role' => 'siswa',
            'nis' => '512376172983',
            'kelas' => 'X IPA 3',
            'kontak' => '6282227342900'
        ]);
        
        User::create([
            'name' => 'Ayu Rahmawati',
            'email' => 'ayurahma@perpus.com',
            'password' => Hash::make('ayu123'),
            'role' => 'siswa',
            'nis' => '512376172984',
            'kelas' => 'X IPA 1',
        ]);
        
        User::create([
            'name' => 'Rizky Hidayat',
            'email' => 'rizkyh@perpus.com',
            'password' => Hash::make('rizky123'),
            'role' => 'siswa',
            'nis' => '512376172985',
            'kelas' => 'X IPA 2'
        ]);
        
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi.l@perpus.com',
            'password' => Hash::make('dewi123'),
            'role' => 'siswa',
            'nis' => '512376172986',
            'kelas' => 'X IPS 1'
        ]);
        
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.s@perpus.com',
            'password' => Hash::make('budi123'),
            'role' => 'siswa',
            'nis' => '512376172987',
            'kelas' => 'X IPS 2'
        ]);
        
        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@perpus.com',
            'password' => Hash::make('siti123'),
            'role' => 'siswa',
            'nis' => '512376172988',
            'kelas' => 'X IPA 1'
        ]);
        
        User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.f@perpus.com',
            'password' => Hash::make('ahmad123'),
            'role' => 'siswa',
            'nis' => '512376172989',
            'kelas' => 'X IPA 3'
        ]);
        
        User::create([
            'name' => 'Nina Kartika',
            'email' => 'nina.k@perpus.com',
            'password' => Hash::make('nina123'),
            'role' => 'siswa',
            'nis' => '512376172990',
            'kelas' => 'X IPS 1'
        ]);
        
        User::create([
            'name' => 'Fajar Pratama',
            'email' => 'fajar.p@perpus.com',
            'password' => Hash::make('fajar123'),
            'role' => 'siswa',
            'nis' => '512376172991',
            'kelas' => 'X IPA 2'
        ]);
        
        User::create([
            'name' => 'Lestari Ayu',
            'email' => 'lestari.ayu@perpus.com',
            'password' => Hash::make('lestari123'),
            'role' => 'siswa',
            'nis' => '512376172992',
            'kelas' => 'X IPS 2'
        ]);

        User::create([
            'name' => 'Ani',
            'email' => 'ani@perpus.com',
            'password' => Hash::make('ani123'),
            'role' => 'admin',
        ]);
    }
}

