<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/rules', [RulesController::class, 'index'])->name('rules');
Route::get('/rating', [RatingController::class, 'index'])->name('rating');

// Маршрут для создания новой игры
Route::middleware(['auth'])->group(function () {
    Route::get('/game/new', [GameController::class, 'create'])->name('game.new');
    Route::post('/game/store', [GameController::class, 'store'])->name('game.store');
});

// Маршрут для редактирования профиля
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('games', GameController::class);
Route::resource('players', PlayerController::class);
