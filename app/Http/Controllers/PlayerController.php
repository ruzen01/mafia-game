<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Game;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

public function index()
{
    $players = Player::with('games')
        ->orderBy('name', 'asc') // 🔥 Сортировка по алфавиту (А → Я)
        ->paginate(15);

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

public function ranking()
{
    $players = Player::select('players.*')
        ->leftJoin('game_player', 'players.id', '=', 'game_player.player_id')
        ->selectRaw('COALESCE(SUM(game_player.score), 0) as total_score')
        ->groupBy('players.id')
        ->orderByDesc('total_score')
        ->with('games')
        ->get();

    return view('players.ranking', compact('players'));
}

 

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }
}
