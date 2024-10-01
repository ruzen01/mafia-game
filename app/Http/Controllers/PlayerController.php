<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Game;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Player::class);
        $players = Player::with('games')->paginate(15);
        return view('players.index', compact('players'));
    }

    public function create()
    {
        $this->authorize('create', Player::class);
        $games = Game::all();
        return view('players.create', compact('games'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Player::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Player::create($validated);

        return redirect()->route('players.index')->with('success', 'Игрок успешно создан');
    }

    public function edit(Player $player)
    {
        $this->authorize('update', $player);
        $games = Game::all();
        return view('players.edit', compact('player', 'games'));
    }

    public function update(Request $request, Player $player)
    {
        $this->authorize('update', $player);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $player->update($validated);

        return redirect()->route('players.index')->with('success', 'Игрок успешно обновлен');
    }

    public function destroy(Player $player)
    {
        $this->authorize('delete', $player);
        if ($player->games()->exists()) {
            return redirect()->route('players.index')->with('error', 'Игрок не может быть удален, так как он участвует в одной или более играх');
        }

        $player->delete();

        return redirect()->route('players.index')->with('success', 'Игрок успешно удален');
    }
}