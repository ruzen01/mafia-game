<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Здесь можно добавить логику для получения статистики пользователя
        $gamesPlayed = 12;  // Пример
        $wins = 8;
        $losses = 4;
        $rating = 1500;

        return view('dashboard', compact('user', 'gamesPlayed', 'wins', 'losses', 'rating'));
    }
}