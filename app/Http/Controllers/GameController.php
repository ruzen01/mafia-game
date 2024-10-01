<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Role;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = Player::all();
        $roles = Role::all();
        $seasons = ['Осень-зима 2024-2025']; // Список сезонов
    
        return view('games.create', compact('players', 'roles', 'seasons'));
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
            'roles' => 'required|array',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
            'best_player' => 'array',
            'first_victim' => 'array',
            'leader_scores' => 'array',
            'comments' => 'array',
            'additional_score' => 'array', // Новое поле
            'season' => 'required|string', // Добавляем валидацию для сезона
        ]);

        $game = Game::create($validated);

        foreach ($validated['players'] as $index => $playerId) {
            $roleId = $validated['roles'][$index];
            $isBestPlayer = in_array($playerId, $validated['best_player'] ?? []);
            $isFirstVictim = in_array($playerId, $validated['first_victim'] ?? []);
            $leaderScore = $validated['leader_scores'][$index] ?? 0;
            $comment = $validated['comments'][$index] ?? null;
            $additionalScore = in_array($playerId, $validated['additional_score'] ?? []) ? 1 : 0;

            // Определение баллов в зависимости от победившей категории
            $roleCategory = Role::find($roleId)->category;
            $score = $roleCategory === $validated['winner'] ? 2 : 0;

            // Итоговый расчет баллов
            $totalScore = $score + ($isBestPlayer ? 2 : 0) + ($isFirstVictim ? 1 : 0) + $leaderScore + $additionalScore;

            // Привязка игрока к игре с рассчитанными баллами
            $game->players()->attach($playerId, [
                'role_id' => $roleId,
                'score' => $totalScore,
                'best_player' => $isBestPlayer,
                'first_victim' => $isFirstVictim,
                'leader_score' => $leaderScore,
                'additional_score' => $additionalScore, // Добавляем новое поле
                'comment' => $comment,
            ]);
        }

        return redirect()->route('games.index')->with('success', 'Игра успешно создана');
    }    
    /**
     * Display the specified resource.
     */
    public function show(Game $game) 
    { 
        // Загрузка игры вместе с игроками и их ролями
        $game->load('players');
    
        // Загрузка всех ролей в виде коллекции, где ключ - это role_id
        $roles = Role::all()->pluck('name', 'id');
    
        return view('games.show', compact('game', 'roles')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $game = Game::with('players')->findOrFail($id);
        $allPlayers = Player::all();
        $roles = Role::all();
        $seasons = ['Осень-зима 2024-2025']; // Список сезонов

        return view('games.edit', compact('game', 'allPlayers', 'roles', 'seasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'players' => 'required|array',
            'roles' => 'required|array',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
            'best_player' => 'array',
            'first_victim' => 'array',
            'leader_scores' => 'array',
            'comments' => 'array',
            'additional_score' => 'array', // Новое поле
        ]);
    
        // Удаление игроков, которые были помечены для удаления
        if ($request->has('players_to_delete')) {
            foreach ($request->players_to_delete as $playerId) {
                $game->players()->detach($playerId);
            }
        }
    
        // Обновляем данные игры
        $game->update($validated);
    
        // Синхронизация игроков
        $syncData = [];
        foreach ($validated['players'] as $index => $playerId) {
            $roleId = $validated['roles'][$index];
            $isBestPlayer = in_array($playerId, $validated['best_player'] ?? []);
            $isFirstVictim = in_array($playerId, $validated['first_victim'] ?? []);
            $leaderScore = $validated['leader_scores'][$index] ?? 0;
            $comment = $validated['comments'][$index] ?? null;
            $additionalScore = in_array($playerId, $validated['additional_score'] ?? []) ? 1 : 0;
    
            $roleCategory = Role::find($roleId)->category;
            $score = $roleCategory === $validated['winner'] ? 2 : 0;
    
            $totalScore = $score + ($isBestPlayer ? 2 : 0) + ($isFirstVictim ? 1 : 0) + $leaderScore + $additionalScore;
    
            $syncData[$playerId] = [
                'role_id' => $roleId,
                'score' => $totalScore,
                'best_player' => $isBestPlayer,
                'first_victim' => $isFirstVictim,
                'leader_score' => $leaderScore,
                'additional_score' => $additionalScore,
                'comment' => $comment,
            ];
        }
    
        // Синхронизируем игроков
        $game->players()->sync($syncData);
    
        return redirect()->route('games.index')->with('success', 'Игра успешно обновлена');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        try {
            // Попытка удалить игру
            $game->delete();
    
            // Передаем сообщение об успехе в сессию
            return redirect()->route('games.index')->with('success', 'Игра успешно удалена.');
        } catch (\Exception $e) {
            // В случае ошибки передаем сообщение об ошибке
            return redirect()->route('games.index')->with('error', 'Ошибка при удалении игры: ' . $e->getMessage());
        }
    }
}