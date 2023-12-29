<?php

use App\Enums\JabatanEnum;
use App\Http\Controllers\DashboardAnalyticController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardAnalyticController::class)->name('dashboard');

    Route::middleware('role:' . JabatanEnum::KEPALA_LANE->value)->group(function () {
        Route::get('/borrow', PeminjamanController::class)
            ->name('borrow.select');

        Route::post('/borrow/{mesin}', [PeminjamanController::class, 'store'])
            ->name('borrow.store');

        Route::post('/borrow/{id}/return', [PeminjamanController::class, 'return'])
            ->name('borrow.return');

        Route::get('/borrow/history', [PeminjamanController::class, 'history'])
            ->name('borrow-history');
    });

    Route::middleware('role:' . JabatanEnum::PETUGAS_GUDANG->value)->group(function () {
        Route::get('/borrow/all', [PeminjamanController::class, 'all'])
            ->name('loan');

        Route::resource('/engines', MesinController::class);

        Route::resource('/warehouses', GudangController::class);
    });

    Route::middleware('role:' . JabatanEnum::ADMIN->value)->group(function () {
        Route::resource('/users', UserController::class);
    });
});

Auth::routes();
