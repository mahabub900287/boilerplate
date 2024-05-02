<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'user'])->group(function () {  // Changed middleware from 'user' to 'auth'
//     Route::get('user/dashboard', [DashboardController::class, 'test'])->name('user.dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    // Additional logic if needed
});



require __DIR__ . '/auth.php';
