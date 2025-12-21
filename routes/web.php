<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\KecKelController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\KoneksiController;
use App\Http\Controllers\BackboneController;
use App\Http\Controllers\UplinkController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\TitikLokasiController;
use App\Http\Controllers\PerangkatDaerahController;
use App\Http\Controllers\JenisMasalahController;
use App\Http\Controllers\BulanController;
use App\Http\Controllers\GangguanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\TransaksiBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;



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

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/captcha/refresh', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'refreshCaptcha'])->name('captcha.refresh');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/peta', [PetaController::class, 'index'])->middleware(['auth', 'verified'])->name('peta');
// JSON detail endpoint for a single titik lokasi (used by map sidebar)
Route::get('/peta/detail/{id}', [PetaController::class, 'detail'])->middleware(['auth', 'verified'])->name('peta.detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', RegisteredUserController::class);
    Route::resource('wilayah', WilayahController::class);
    Route::resource('kec_kel', KecKelController::class);
    Route::resource('klasifikasi', KlasifikasiController::class);
    Route::resource('koneksi', KoneksiController::class);
    Route::resource('backbone', BackboneController::class);
    Route::resource('uplink', UplinkController::class);
    Route::resource('perangkat', PerangkatController::class);
    Route::resource('titik_lokasi', TitikLokasiController::class);
    Route::get('/titik_lokasi/export/pdf', [TitikLokasiController::class, 'exportPdf'])->name('titik_lokasi.exportPdf');
    Route::resource('perangkatdaerah', PerangkatDaerahController::class)->middleware('auth');
    Route::resource('jenis_masalah', JenisMasalahController::class)->middleware('auth');
    Route::resource('bulan', BulanController::class)->middleware('auth');
    Route::resource('gangguan', GangguanController::class)->middleware('auth');
    Route::get('/gangguan/export/pdf', [GangguanController::class, 'exportPdf'])->name('gangguan.exportPdf');
    Route::resource('barang', BarangController::class)->middleware('auth');
    Route::resource('stok_barang', StokBarangController::class)->middleware('auth');
    Route::get('/stok-barang/export/pdf', [StokBarangController::class, 'exportPdf'])->name('stok_barang.exportPdf');
    Route::get('/barang/{id}/jenis', [BarangController::class, 'getJenisBarang']);
    Route::resource('lokasi', LokasiController::class)->middleware('auth');
    Route::resource('transaksi_barang', TransaksiBarangController::class)->middleware('auth');
    Route::get('/barang-keluar/export/pdf', [TransaksiBarangController::class, 'cetakPdf']
    )->name('transaksi_barang.pdf');
    Route::get('/api/gangguan/chart', [App\Http\Controllers\DashboardController::class, 'gangguanChart']);





});

require __DIR__.'/auth.php';
