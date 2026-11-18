<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginRedirectController;
use App\Http\Controllers\Auth\StructureSelectionController;
use App\Http\Controllers\MasaKhidmat;



Route::inertia('/', 'welcome')->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::inertia('dashboard', 'dashboard')->name('dashboard');
//     // Route::middleware(['role:operator,anggota'])->group(function () {
    
//     //     Route::get('masa-khidmat', [MasaKhidmat::class, 'index'])
//     //         ->name('masa-khidmat.index');
//     // });
// });

Route::middleware('auth')->group(function () {
    Route::get('masa-khidmat', [MasaKhidmat::class, 'index'])->name('masa-khidmat.index');

    Route::get('/login-redirect', [
        LoginRedirectController::class,
        'index'
    ])->middleware('auth')->name('login.redirect');

    Route::get('/pilih-struktur', [
        StructureSelectionController::class,
        'index'
    ])->name('struktur.select');

    Route::post('/pilih-struktur', [
        StructureSelectionController::class,
        'store'
    ])->name('struktur.select.store');

    Route::get('/dashboard', function () {
         \Log::info('ROUTE DASHBOARD DIJALANKAN');

        return inertia('dashboard');
    })->middleware('active.structure')
        ->name('dashboard');
});

require __DIR__ . '/settings.php';
