<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GameController extends Controller
{
public function index()
{
    $games = Game::with('players.role')->get(); // ← вот так!
    return view('games.index', compact('games'));
}

    public function create()
    {
        $this->authorize('create', Game::class);
        
        // 🔥 Сортировка игроков по алфавиту
        $players = Player::orderBy('name')->get();
        
        $roles = Role::all();
        $seasons = ['Осень 2025'];

        return view('games.create', compact('players', 'roles', 'seasons'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Game::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
            'season' => 'required|string',
            'players' => 'required|array|min:1',
            'players.*.id' => 'required|exists:players,id',
            'players.*.role_id' => 'required|exists:roles,id',
            'players.*.leader_score' => 'nullable|integer|min:0',
            'players.*.comment' => 'nullable|string|max:500',
            'players.*.best_player' => 'required|in:0,1',
            'players.*.first_victim' => 'required|in:0,1',
            'players.*.additional_score' => 'required|in:0,1',
        ], [
            'players.*.best_player.required' => 'Поле "Лучший" обязательно.',
            'players.*.first_victim.required' => 'Поле "Первая кровь" обязательно.',
            'players.*.additional_score.required' => 'Поле "Доп." обязательно.',
        ]);

        // Проверка дубликатов
        $playerIds = collect($validated['players'])->pluck('id');
        if ($playerIds->count() !== $playerIds->unique()->count()) {
            throw ValidationException::withMessages([
                'players' => 'Нельзя добавлять одного и того же игрока дважды.'
            ]);
        }

        $game = Game::create([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'game_number' => $validated['game_number'],
            'host_name' => $validated['host_name'],
            'winner' => $validated['winner'],
            'season' => $validated['season'],
        ]);

        foreach ($validated['players'] as $data) {
            $role = Role::find($data['role_id']);
            $score = $role->category === $validated['winner'] ? 2 : 0;

            $totalScore = $score
                + ($data['best_player'] ? 2 : 0)
                + ($data['first_victim'] ? 1 : 0)
                + ($data['leader_score'] ?? 0)
                + ($data['additional_score'] ? 1 : 0);

            $game->players()->attach($data['id'], [
                'role_id' => $data['role_id'],
                'score' => $totalScore,
                'best_player' => $data['best_player'],
                'first_victim' => $data['first_victim'],
                'leader_score' => $data['leader_score'] ?? 0,
                'additional_score' => $data['additional_score'],
                'comment' => $data['comment'] ?? null,
            ]);
        }

        return redirect()->route('games.index')->with('success', 'Игра успешно создана');
    }

    public function show(Game $game)
    {
        $game->load('players');
        $roles = Role::all()->pluck('name', 'id');

        return view('games.show', compact('game', 'roles'));
    }

    public function edit($id)
    {
        $game = Game::with('players')->findOrFail($id);
        $this->authorize('update', $game);
        
        // 🔥 Сортировка всех игроков по алфавиту
        $allPlayers = Player::orderBy('name')->get();
        
        $roles = Role::all();
        $seasons = ['Осень 2025'];

        return view('games.edit', compact('game', 'allPlayers', 'roles', 'seasons'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $this->authorize('update', $game);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'game_number' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
            'season' => 'required|string',
            'players' => 'required|array|min:1',
            'players.*.id' => 'required|exists:players,id',
            'players.*.role_id' => 'required|exists:roles,id',
            'players.*.leader_score' => 'nullable|integer|min:0',
            'players.*.comment' => 'nullable|string|max:500',
            'players.*.best_player' => 'required|in:0,1',
            'players.*.first_victim' => 'required|in:0,1',
            'players.*.additional_score' => 'required|in:0,1',
        ], [
            'players.*.best_player.required' => 'Поле "Лучший" обязательно.',
            'players.*.first_victim.required' => 'Поле "Первая кровь" обязательно.',
            'players.*.additional_score.required' => 'Поле "Доп." обязательно.',
        ]);

        $playerIds = collect($validated['players'])->pluck('id');
        if ($playerIds->count() !== $playerIds->unique()->count()) {
            throw ValidationException::withMessages([
                'players' => 'Нельзя добавлять одного и того же игрока дважды.'
            ]);
        }

        $game->update([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'game_number' => $validated['game_number'],
            'host_name' => $validated['host_name'],
            'winner' => $validated['winner'],
            'season' => $validated['season'],
        ]);

        $syncData = [];
        foreach ($validated['players'] as $data) {
            $role = Role::find($data['role_id']);
            $score = $role->category === $validated['winner'] ? 2 : 0;

            $totalScore = $score
                + ($data['best_player'] ? 2 : 0)
                + ($data['first_victim'] ? 1 : 0)
                + ($data['leader_score'] ?? 0)
                + ($data['additional_score'] ? 1 : 0);

            $syncData[$data['id']] = [
                'role_id' => $data['role_id'],
                'score' => $totalScore,
                'best_player' => $data['best_player'],
                'first_victim' => $data['first_victim'],
                'leader_score' => $data['leader_score'] ?? 0,
                'additional_score' => $data['additional_score'],
                'comment' => $data['comment'] ?? null,
            ];
        }

        $game->players()->sync($syncData);

        return redirect()->route('games.index')->with('success', 'Игра успешно обновлена');
    }

    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        try {
            $game->delete();
            return redirect()->route('games.index')->with('success', 'Игра успешно удалена.');
        } catch (\Exception $e) {
            return redirect()->route('games.index')->with('error', 'Ошибка при удалении игры: ' . $e->getMessage());
        }
    }
}