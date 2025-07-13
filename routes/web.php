<?php

use App\Http\Controllers\C_auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_buku;
use App\Http\Controllers\C_buku_tamu;
use App\Http\Controllers\C_anggota;
use App\Http\Controllers\C_peminjaman;
use App\Http\Controllers\C_pengembalian;
use App\Http\Controllers\C_denda;
use App\Http\Controllers\C_laporan;
use App\Http\Controllers\C_dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [C_auth::class, 'login'])->name('login');
Route::get('/login', [C_auth::class, 'login'])->name('login');
Route::post('/login', [C_auth::class, 'loginProcess'])->name('login.process');
Route::get('/cetak-laporan', [C_laporan::class, 'cetak'])->name('cetak.laporan');
Route::get('/cetak-laporan_tamu', [C_laporan::class, 'cetak_tamu'])->name('cetak.laporan.tamu');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [C_auth::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard-admin', [C_dashboard::class, 'admin'])->name('admin.dashboard');

        Route::resource('buku', C_buku::class);
        Route::resource('buku-tamu', C_buku_tamu::class);
        Route::resource('anggota', C_anggota::class);
        Route::resource('peminjaman', C_peminjaman::class);
        Route::resource('pengembalian', C_pengembalian::class);
        Route::resource('denda', C_denda::class);
        Route::get('/laporan', [C_laporan::class, 'index'])->name('laporan.transaksi');
        Route::get('/laporan_tamu', [C_laporan::class, 'index_tamu'])->name('laporan.tamu');

        Route::get('/kirim', [C_pengembalian::class, 'kirim'])->name('kirim');

    });

    Route::middleware(['auth', 'role:kepala_sekolah'])->group(function () {
        Route::get('/dashboard-kepsek', [C_dashboard::class, 'kepala'])->name('kepala.dashboard');
        Route::get('/laporan-kepala', [C_laporan::class, 'index'])->name('laporan.kepala');
        Route::get('/laporan_tamu-kepala', [C_laporan::class, 'index_tamu'])->name('laporan.kepala.tamu');
    });

    Route::middleware(['auth', 'role:siswa'])->group(function () {
        Route::get('/dashboard-siswa', [C_dashboard::class, 'siswa'])->name('siswa.dashboard');
        Route::get('/lihat-buku', [C_buku::class, 'index'])->name('lihat.buku');
        Route::get('/lihat-peminjaman', [C_peminjaman::class, 'index'])->name('lihat.peminjaman');

    });
});
