<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MasterbarangController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//kategori
Route::resource('kategori', KategoriController::class);
Route::get('/data/kategori', [KategoriController::class, 'data'])->name('kategori.data');

//lokasi
Route::resource('lokasi', LokasiController::class);
Route::get('/data/lokasi', [LokasiController::class, 'data'])->name('lokasi.data');

//master_barang
Route::resource('barang', MasterbarangController::class);
Route::get('/getlokasi/{lokasi}',[MasterbarangController::class, 'getDept'])->name('barang.lokasi');
Route::get('/data/barang', [MasterbarangController::class, 'data'])->name('barang.data');
