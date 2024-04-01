<?php

use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SatuanController;
use App\Models\ProductType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductTypeController;

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
});
