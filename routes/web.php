<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pembeli\PembeliController;
use App\Http\Controllers\Pembeli\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/reset', function () {
//     return view('email.lupa_password');
// });

Route::get('/', [PembeliController::class, 'index'])->name('halaman-utama');

// AUTH
Route::get('/login', [LoginController::class, 'index'])->name('index-login');
Route::get('/daftar', [LoginController::class, 'index_daftar'])->name('index-daftar');
Route::get('/lupa-password', [LoginController::class, 'index_lupa_password'])->name('index-lupa-password');
Route::get('/reset-password/{token}', [LoginController::class, 'index_reset_password'])->name('index-reset-password');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::post('/lupa-password', [LoginController::class, 'lupa_password'])->name('lupa-password');
Route::post('/reset-password/{id}', [LoginController::class, 'reset_password'])->name('reset-password');

Route::get('/verifikasi/{email}', [LoginController::class, 'verifikasi'])->name('verifikasi');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// AKHIR AUTH


// PEMBELI
Route::get('/produk', [PembeliController::class, 'data_produk'])->name('data-produk');
Route::get('/paginate', [PembeliController::class, 'data_produk_paginate'])->name('paginate');
Route::get('/tentang', [PembeliController::class, 'data_tentang'])->name('data-tentang');
Route::get('/kontak', [PembeliController::class, 'data_kontak'])->name('data-kontak');






Route::group(['middleware' => ['auth', 'checkrole:1']], function () {

    // DASHBOARD
    Route::get('/data-chart/{tanggal_pertama}/{tanggal_kedua}', [DashboardController::class, 'data_chart']);
    Route::resource('dashboard', DashboardController::class, ['names' => 'dashboard']);

    // BARANG
    Route::get('/barang/ganti-status/{id}', [BarangController::class, 'ganti_status'])->name('ganti-status-barang');
    Route::get('/barang/hapus-barang/{id}', [BarangController::class, 'destroy'])->name('hapus-barang');
    Route::get('/barang/ukuran-barang/{id}', [BarangController::class, 'ukuran_barang'])->name('ukuran-barang');
    Route::get('/barang/kelola-ukuran/{status}/{id}/{value}', [BarangController::class, 'kelola_ukuran'])->name('kelola-ukuran');
    Route::resource('barang', BarangController::class, ['names' => 'barang']);

    // DATA TRANSAKSI ADMIN
    Route::get('/transaksi-verifikasi', [TransaksiAdminController::class, 'index_verifikasi'])->name('index-verifikasi');
    Route::get('/transaksi-belum-dikemas', [TransaksiAdminController::class, 'index_dikemas'])->name('index-dikemas');
    Route::get('/transaksi-dikirim', [TransaksiAdminController::class, 'index_dikirim'])->name('index-dikirim');
    Route::get('/transaksi-selesai', [TransaksiAdminController::class, 'index_selesai'])->name('index-selesai');
    Route::get('/transaksi-dibatalkan', [TransaksiAdminController::class, 'index_dibatalkan'])->name('index-dibatalkan');
    Route::get('/transaksi-pengembalian', [TransaksiAdminController::class, 'index_pengembalian'])->name('index-pengembalian');


    Route::get('/ganti-status-transaksi/{id}/{status}', [TransaksiAdminController::class, 'ganti_status_transaksi'])->name('ganti-status-transaksi');
    Route::get('/detail-transaksi/{id}/{status}', [TransaksiAdminController::class, 'show'])->name('detail-transaksi');
    Route::get('/upload-bukti/{id}', [TransaksiAdminController::class, 'create'])->name('upload-bukti');
    Route::post('/upload-bukti/{id}', [TransaksiAdminController::class, 'update'])->name('upload-bukti-penerima');

    Route::get('/cek-transaksi', [TransaksiAdminController::class, 'cek_transaksi'])->name('cek-transaksi');
});

Route::group(['middleware' => ['auth', 'checkrole:2']], function () {

    // KERANJANG
    Route::get('/keranjang/data-keranjang', [PembeliController::class, 'data_keranjang'])->name('data-keranjang');
    Route::get('/keranjang/tambah-keranjang/{id}/{status}', [PembeliController::class, 'tambah_keranjang'])->name('tambah-keranjang');
    Route::get('/keranjang/simpan-keranjang/{barang}/{ukuran}/{jumlah}/{status}', [PembeliController::class, 'simpan_keranjang']);
    Route::get('/keranjang/data-ukuran/{id}', [PembeliController::class, 'data_ukuran'])->name('data-ukuran');
    Route::get('/keranjang/total/{id}', [PembeliController::class, 'total']);
    Route::get('/keranjang/hapus-keranjang/{id}', [PembeliController::class, 'hapus_keranjang'])->name('hapus-keranjang');
    Route::get('/keranjang/jumlah-keranjang/{id}/{jumlah}', [PembeliController::class, 'jumlah']);
    Route::get('/keranjang', [PembeliController::class, 'keranjang_pembeli'])->name('index-keranjang');
    Route::get('/checkout/{status}', [PembeliController::class, 'checkout'])->name('checkout');
    Route::get('/centang-semua/{status}', [PembeliController::class, 'centang_semua']);
    Route::post('/buat-pesanan', [PembeliController::class, 'buat_pesanan'])->name('buat-pesanan');

    // PESANAN
    Route::get('/pesanan/index-bayar-pesanan/{id}', [TransaksiController::class, 'index_bayar_pesanan'])->name('index-bayar-pesanan');
    Route::get('/pesanan/index-pengembalian-barang/{id}', [TransaksiController::class, 'pengembalian_barang'])->name('index-pengembalian-barang');
    Route::resource('pesanan', TransaksiController::class, ['names' => 'pesanan']);

    // PROFILE
    Route::get('/profile', [PembeliController::class, 'index_profile'])->name('index-profile');
    Route::post('/profile', [PembeliController::class, 'update_profile'])->name('update-profile');
});
