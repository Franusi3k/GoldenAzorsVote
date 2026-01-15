<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Admin\PollController;
use \App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/polls', PollController::class)->only(['index', 'show', 'update', 'destroy']);

        Route::resource('/users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
    });

Route::middleware(['auth', 'role:user'])
    ->name('user.')
    ->prefix('user')
    ->group(function () {
        
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    });

require __DIR__.'/auth.php';
