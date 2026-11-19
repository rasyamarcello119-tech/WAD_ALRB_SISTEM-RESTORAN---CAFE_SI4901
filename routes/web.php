<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (): void {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store'])
        ->middleware('throttle:20,1')->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

    Route::get('menu', [MenuController::class, 'index'])
        ->middleware('role:'.User::ROLE_ADMIN.','.User::ROLE_USER)->name('menu.index');

    Route::resource('menu', MenuController::class)
        ->except(['index', 'show'])->middleware('role:'.User::ROLE_ADMIN);
});
