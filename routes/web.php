<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LapStokBarangController;
use App\Http\Controllers\LapBarangMasukController;
use App\Http\Controllers\LapBarangKeluarController;

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
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::resource('jenisBarang', JenisBarangController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('barangmasuk', BarangMasukController::class);
    Route::get('barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
    Route::get('/barangkeluar/create', [BarangKeluarController::class, 'create'])->name('barangkeluar.create');
    Route::post('/barangkeluar', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
    Route::get('/barangkeluar/{barangkeluar_kode}', [BarangKeluarController::class, 'show'])->name('barangkeluar.show');
    Route::get('/barangkeluar/{barangkeluar_kode}/edit', [BarangKeluarController::class, 'edit'])->name('barangkeluar.edit');
    Route::put('/barangkeluar/{barangkeluar_kode}', [BarangKeluarController::class, 'update'])->name('barangkeluar.update');
    Route::delete('/barangkeluar/{barangkeluar_kode}', [BarangKeluarController::class, 'destroy'])->name('barangkeluar.destroy');
    Route::resource('settings', SettingsController::class);
    Route::resource('pengguna', UserController::class);
    Route::resource('ekspedisi', EkspedisiController::class);
    Route::get('invoice-pdf/{barangkeluar_kode}', [PdfController::class, 'invoicePDF'])->name('invoice-pdf');
    Route::get('/laporan/barangmasuk', [LapBarangMasukController::class, 'index'])->name('laporan.barangmasuk.index');
    Route::get('/laporan/barangmasuk/pdf', [LapBarangMasukController::class, 'pdf'])->name('laporan.barangmasuk.pdf');
    Route::get('/laporan/barangmasuk/view-pdf', [LapBarangMasukController::class, 'viewPdf'])->name('laporan.barangmasuk.viewPdf');
    Route::get('/laporan/barangkeluar', [LapBarangKeluarController::class, 'index'])->name('laporan.barangkeluar.index');
    Route::get('/laporan/barangkeluar/pdf', [LapBarangKeluarController::class, 'pdf'])->name('laporan.barangkeluar.pdf');
    Route::get('/laporan/barangkeluar/view-pdf', [LapBarangKeluarController::class, 'viewPdf'])->name('laporan.barangkeluar.viewPdf');
    Route::get('/laporan/stokbarang', [LapStokBarangController::class, 'index'])->name('laporan.stokbarang.index');
    Route::get('/laporan/stokbarang/pdf', [LapStokBarangController::class, 'pdf'])->name('laporan.stokbarang.pdf');
    Route::get('/laporan/stokbarang/view-pdf', [LapStokBarangController::class, 'viewPdf'])->name('laporan.stokbarang.viewPdf');
});
