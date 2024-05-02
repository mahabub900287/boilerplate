<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;  // Corrected namespace

Route::middleware(['user'])->group(function () {  // Changed middleware from 'user' to 'auth'
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
