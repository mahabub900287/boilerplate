<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\New\AdminController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/{id}', [AdminProfileController::class, 'profileEdit'])->name('profile.edit');
    Route::post('/profile/update/{id}', [AdminProfileController::class, 'profileupdate'])->name('profile.update');
    //user
    Route::resource('users', UserController::class);
    Route::resource('new-admin', AdminController::class);
    // Role Permissions
    Route::resource('/roles', RolePermissionController::class);

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/application-settings', 'index')->name('application.settings');
        Route::post('/application-settings-update', 'update')->name('application.settings-update');
    });
});
