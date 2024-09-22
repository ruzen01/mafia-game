<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all(); // Загружаем все игры
        return view('games.index', compact('games')); // Передаём список игр в шаблон
    }

    public function create()
    {
        $players = Player::all();
        return view('games.create', compact('players'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|integer',
            'host_name' => 'required|string|max:255', // Поле host_name
            'result' => 'required|string',
            'players' => 'nullable|array',
            'players.*.player_id' => 'nullable|exists:players,id',
            'players.*.custom_name' => 'nullable|string|max:255',
        ]);
    
        // Создание новой игры
        Game::create($validatedData);
    
        return redirect()->route('games.index')->with('success', 'Игра успешно добавлена');
    }

    public function start(Game $game)
    {
        if (Auth::id() !== $game->host_id) {
            return redirect()->route('dashboard')->with('error', 'Вы не можете начать эту игру.');
        }

        $game->update(['status' => 'started']);
        return redirect()->route('dashboard')->with('success', 'Игра начата!');
    }

    public function show($id)
    {
        $game = Game::with(['host', 'players'])->findOrFail($id);
        return view('games.show', compact('game'));
    }
}