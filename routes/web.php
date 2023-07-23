<?php

use App\Http\Controllers\BarangkembaliController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MasterbarangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SerahterimaController;
use App\Http\Controllers\SerahterimadetailController;
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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);



require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function() {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    //kategori
    Route::resource('kategori', KategoriController::class);
    Route::get('/data/kategori', [KategoriController::class, 'data'])->name('kategori.data');
    
    //lokasi
    Route::resource('lokasi', LokasiController::class)
        ->except('edit');
    Route::get('/data/lokasi', [LokasiController::class, 'data'])->name('lokasi.data');
    Route::get('/lokasi/edit/{id}', [LokasiController::class, 'edit'])->name('lokasi.edit');

    //departemen
    Route::resource('departemen', DepartemenController::class);
    Route::get('data/departemen', [DepartemenController::class, 'data'])->name('departemen.data');
    
    //master_barang
    Route::resource('barang', MasterbarangController::class)
        ->except('show', 'destroy');
    Route::get('/getlokasi/{lokasi}',[MasterbarangController::class, 'getDept'])->name('barang.lokasi');
    Route::get('/getkode/{kategori}',[MasterbarangController::class, 'getkode'])->name('barang.kode');
    Route::get('/data/barang', [MasterbarangController::class, 'data'])->name('barang.data');
    Route::get('/barang/kembali/{barang}', [MasterbarangController::class, 'kembali'])->name('barang.kembali');
    Route::post('/barang/generate', [MasterbarangController::class, 'generateQr'])->name('barang.generate');
    Route::delete('/barang/{id_barang}', [MasterbarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('barang/show', [MasterbarangController::class, 'show']);

    //permintaan_barang
    Route::resource('serah', SerahterimaController::class)
        ->except('update');
    Route::post('detail/update', [SerahterimaController::class, 'update'])->name('serah.update');
    Route::get('/getlokasi/{lokasi}',[SerahterimaController::class, 'getDept'])->name('serah.lokasi');
    Route::get('/data/serah', [SerahterimaController::class, 'data'])->name('serah.data');
    Route::get('/selesai',[SerahterimaController::class, 'selesai'])->name('serah.selesai');
    Route::get('/cetak',[SerahterimaController::class, 'cetak'])->name('serah.cetak');
    Route::get('/diambil/{serah}', [SerahterimaController::class, 'diambil'])->name('serah.diambil');
    Route::get('/serah/detail/{detail}', [SerahterimaController::class, 'detail'])->name('serah.detail');
    
    //detail_barang
    Route::resource('detail', SerahterimadetailController::class)
        ->except('store', 'update');
    Route::get('store/{id}/detail', [SerahterimadetailController::class, 'store'])->name('detail.store');
    Route::get('/data/detail/{id}', [SerahterimadetailController::class, 'data'])->name('serah_detail.data');

    //barang_kembali
    Route::resource('kembali', BarangkembaliController::class);
    Route::get('/kembali/selesai/{detail}', [BarangkembaliController::class, 'kembali_selesai'])->name('kembali.selesai');
    Route::get('/kembali/rusak/{detail}', [BarangkembaliController::class, 'kembali_rusak'])->name('kembali.rusak');

    //maintenance
    Route::resource('maintenance', MaintenanceController::class);
    Route::get('/form', [MaintenanceController::class, 'form'])->name('maintenance.form');
    Route::get('/formkembali/{detail}', [MaintenanceController::class, 'formkembali'])->name('maintenance.formkembali');
    Route::post('/service/{maintenance}', [MaintenanceController::class, 'tindakLanjut'])->name('maintenance.service');
    Route::post('/selesai/{maintenance}', [MaintenanceController::class, 'selesai'])->name('maintenance.selesai');

    //reporting
    Route::get('/report', [ReportController::class, 'index']);
    Route::get('/report/{lokasi}', [ReportController::class, 'getTotal']);
    });

