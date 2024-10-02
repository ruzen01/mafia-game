<?php

use App\Http\Controllers\ProfileController;
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

Route::resource('games', GameController::class);

Route::get('/players/ranking', [PlayerController::class, 'ranking'])->name('players.ranking');
Route::resource('players', PlayerController::class);