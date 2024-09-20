<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('host')->orderBy('date', 'desc')->get();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $players = Player::all();
        return view('games.create', compact('players'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'date' => 'required|date',
            'game_number' => 'required|integer',
            'host_id' => 'required|exists:players,id',
            'result' => 'required|string',
            'players' => 'required|array',
            'players.*.player_id' => 'required|exists:players,id',
            'players.*.role' => 'required|string',
            'players.*.total_points' => 'required|integer',
            'players.*.additional_points' => 'required|integer',
            'players.*.from_host_points' => 'required|integer',
            'players.*.comment' => 'nullable|string',
        ]);

        // Создание игры
        $game = Game::create([
            'date' => $validatedData['date'],
            'game_number' => $validatedData['game_number'],
            'host_id' => $validatedData['host_id'],
            'result' => $validatedData['result'],
        ]);

        // Привязка игроков к игре
        foreach ($validatedData['players'] as $playerData) {
            $game->players()->attach($playerData['player_id'], [
                'role' => $playerData['role'],
                'total_points' => $playerData['total_points'],
                'additional_points' => $playerData['additional_points'],
                'best_player' => isset($playerData['best_player']),
                'first_victim' => isset($playerData['first_victim']),
                'from_host_points' => $playerData['from_host_points'],
                'comment' => $playerData['comment'],
            ]);
        }

        return redirect()->route('games.index')->with('success', 'Игра успешно добавлена!');
    }

    public function start(Game $game)
    {
        // Проверка, является ли текущий пользователь хостом игры
        if (Auth::id() !== $game->host_id) {
            return redirect()->route('dashboard')->with('error', 'Вы не можете начать эту игру.');
        }

        // Обновление статуса игры на "начата"
        $game->update(['status' => 'started']);

        return redirect()->route('dashboard')->with('success', 'Игра начата!');
    }

    public function show($id)
    {
        $game = Game::with(['host', 'players'])->findOrFail($id);

        return view('games.show', compact('game'));
    }
}