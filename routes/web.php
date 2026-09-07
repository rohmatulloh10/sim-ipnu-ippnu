<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MasaKhidmat;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::get('masa-khidmat', [MasaKhidmat::class, 'index'])->name('masa-khidmat.index');
});

require __DIR__ . '/settings.php';
