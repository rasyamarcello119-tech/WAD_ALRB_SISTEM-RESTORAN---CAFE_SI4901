<?php

use App\Http\Controllers\MenuController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')
    ->middleware(['throttle:60,1', 'menu.api', 'role:'.User::ROLE_ADMIN.','.User::ROLE_USER])
    ->group(function (): void {
        Route::get('menu', [MenuController::class, 'apiIndex'])->name('menu.index');
        Route::get('menu/{menu}', [MenuController::class, 'apiShow'])->name('menu.show');

        Route::apiResource('menu', MenuController::class)
            ->only(['store', 'update', 'destroy'])
            ->middleware('role:'.User::ROLE_ADMIN);
    });
