<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User routes
    Route::resource('/users', UserController::class);

    // Trash routes
    Route::prefix('trashes')->group(function () {
        Route::get('/', [TrashController::class, 'index'])->name('trashes.index');
        Route::patch('{model}/{id}', [TrashController::class, 'restoreFromTrash'])->name('trashes.restore');
        Route::delete('{model}/{id}/destroy', [TrashController::class, 'deleteFromTrash'])->name('trashes.destroy');
    });
});

require __DIR__ . '/auth.php';
