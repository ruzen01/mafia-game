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
        // Получаем все роли
        $roles = Role::all();

        // Передаем игроков и роли в представление
        return view('games.create', compact('players', 'roles'));
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
            'scores' => 'required|array',
            'players.*' => 'exists:players,id',
            'roles.*' => 'exists:roles,id',
            'scores.*' => 'integer|min:0',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
        ]);

        $game = Game::create($validated);

        foreach ($validated['players'] as $index => $playerId) {
            $roleId = $validated['roles'][$index];
            $game->players()->attach($playerId, ['role_id' => $roleId, 'score' => $validated['scores'][$index]]);
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
    public function edit($id)
    {
        $game = Game::with('players')->findOrFail($id);
        $allPlayers = Player::all();  // Получаем всех игроков для выбора
        $roles = Role::all();  // Получаем все роли

        return view('games.edit', compact('game', 'allPlayers', 'roles'));
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
            'scores' => 'required|array',
            'players.*' => 'exists:players,id',
            'roles.*' => 'exists:roles,id',
            'scores.*' => 'integer|min:0',
            'winner' => 'required|string|in:Мафия,Мирные жители,Третья сторона',
        ]);

        $game->update($validated);

        $syncData = [];
        foreach ($validated['players'] as $index => $playerId) {
            $syncData[$playerId] = ['role_id' => $validated['roles'][$index], 'score' => $validated['scores'][$index]];
        }

        $game->players()->sync($syncData);

        return redirect()->route('games.index')->with('success', 'Игра успешно обновлена!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
