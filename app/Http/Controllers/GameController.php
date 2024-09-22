<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Получаем всех игроков
        $players = Player::all();
    
        // Передаем игроков в представление
        return view('games.create', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'players' => 'required|array',
            'scores' => 'required|array',
            'players.*' => 'exists:players,id',
            'scores.*' => 'integer|min:0',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона', // добавлено поле
        ]);
    
        // Создание новой игры
        $game = Game::create([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'game_number' => $validated['game_number'],
            'host_name' => $validated['host_name'],
            'winner' => $validated['winner'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Привязка игроков к игре с баллами
        foreach ($validated['players'] as $index => $player_id) {
            $game->players()->attach($player_id, ['score' => $validated['scores'][$index]]);
        }
    
        return redirect()->route('games.index')->with('success', 'Игра успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        // Загружаем игру вместе с её игроками
        $game->load('players');
    
        // Получаем всех игроков
        $players = Player::all();
    
        // Передаем игру и список игроков в шаблон
        return view('games.edit', compact('game', 'players'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        // Валидируем входящие данные
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'players' => 'array',
            'scores' => 'array',
        ]);
    
        // Обновляем основные поля игры
        $game->update([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'game_number' => $validated['game_number'],
            'host_name' => $validated['host_name'],
        ]);
    
        // Очищаем текущие записи игроков и добавляем новые
        $players = $validated['players'] ?? [];
        $scores = $validated['scores'] ?? [];
    
        // Привязываем игроков с их баллами
        $syncData = [];
        foreach ($players as $index => $playerId) {
            $syncData[$playerId] = ['score' => $scores[$index]];
        }
        $game->players()->sync($syncData);
    
        // Перенаправляем обратно с сообщением об успехе
        return redirect()->route('games.index')->with('success', 'Игра успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
