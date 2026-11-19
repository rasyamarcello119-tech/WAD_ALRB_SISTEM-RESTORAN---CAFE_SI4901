
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

Route::get('/', [PegawaiController::class, 'index']);

Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');

Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');

Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');

Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');