<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Role;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        $this->authorize('create', Game::class); // Политика для создания игр
        $players = Player::all();
        $roles = Role::all();
        $seasons = ['Осень 2025'];

        return view('games.create', compact('players', 'roles', 'seasons'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Game::class); // Политика для создания игр
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
            'additional_score' => 'array',
            'season' => 'required|string',
        ]);

        $game = Game::create($validated);

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

            $game->players()->attach($playerId, [
                'role_id' => $roleId,
                'score' => $totalScore,
                'best_player' => $isBestPlayer,
                'first_victim' => $isFirstVictim,
                'leader_score' => $leaderScore,
                'additional_score' => $additionalScore,
                'comment' => $comment,
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
        $allPlayers = Player::all();
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
            'players' => 'required|array',
            'roles' => 'required|array',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
            'best_player' => 'array',
            'first_victim' => 'array',
            'leader_scores' => 'array',
            'comments' => 'array',
            'additional_score' => 'array',
        ]);

        if ($request->has('players_to_delete')) {
            foreach ($request->players_to_delete as $playerId) {
                $game->players()->detach($playerId);
            }
        }

        $game->update($validated);

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
