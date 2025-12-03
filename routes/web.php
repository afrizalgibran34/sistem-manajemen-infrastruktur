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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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





});

require __DIR__.'/auth.php';
