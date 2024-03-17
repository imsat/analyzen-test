<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User routes
    Route::patch('/users/{id}/restore', [UserController::class, 'restoreFromTrash'])->name('users.restore');
    Route::delete('/users/{id}/permanently-destroy', [UserController::class, 'deleteFromTrash'])->name('users.permanently-destroy');
    Route::resource('/users', UserController::class);

    // Trash routes
    Route::get('/trashes', [TrashController::class, 'index'])->name('trashes.index');
});

require __DIR__ . '/auth.php';
