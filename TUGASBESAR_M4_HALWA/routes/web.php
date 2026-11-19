<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('meja.index');
});

// Menampilkan semua data meja
Route::get('/meja', [MejaController::class, 'index'])
    ->name('meja.index');

// Menampilkan form tambah meja
Route::get('/meja/create', [MejaController::class, 'create'])
    ->name('meja.create');

// Menyimpan data meja baru
Route::post('/meja', [MejaController::class, 'store'])
    ->name('meja.store');

// Menampilkan form edit meja
Route::get('/meja/{id}/edit', [MejaController::class, 'edit'])
    ->name('meja.edit');

// Memperbarui data meja 
Route::put('/meja/{id}', [MejaController::class, 'update'])
    ->name('meja.update');

// Menghapus data meja
Route::delete('/meja/{id}', [MejaController::class, 'destroy'])
    ->name('meja.destroy');
