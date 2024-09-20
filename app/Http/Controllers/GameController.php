<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function create()
    {
        return view('game.create');
    }

    public function store(Request $request)
    {
        // Логика создания новой игры
        $game = Game::create([
            'user_id' => Auth::id(),
            'status' => 'in_progress',
            'result' => null,
            'score' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', 'Игра начата!');
    }
}