<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\KecKelController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\KoneksiController;
use App\Http\Controllers\StatusController;
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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;



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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/peta', [PetaController::class, 'index'])->middleware(['auth', 'verified'])->name('peta');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('wilayah', WilayahController::class);
    Route::resource('kec_kel', KecKelController::class);
    Route::resource('klasifikasi', KlasifikasiController::class);
    Route::resource('koneksi', KoneksiController::class);
    Route::resource('status', StatusController::class);
    Route::resource('backbone', BackboneController::class);
    Route::resource('uplink', UplinkController::class);
    Route::resource('perangkat', PerangkatController::class);
    Route::resource('titik_lokasi', TitikLokasiController::class);
    Route::resource('perangkatdaerah', PerangkatDaerahController::class)->middleware('auth');
    Route::resource('jenis_masalah', JenisMasalahController::class)->middleware('auth');
    Route::resource('bulan', BulanController::class)->middleware('auth');
    Route::resource('gangguan', GangguanController::class)->middleware('auth');
    Route::resource('barang', BarangController::class)->middleware('auth');
    Route::resource('stok_barang', StokBarangController::class)->middleware('auth');




});

require __DIR__.'/auth.php';
