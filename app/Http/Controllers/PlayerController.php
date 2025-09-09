<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Game;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlayerController extends Controller
{
public function index()
{
    // Получаем всех игроков с суммой баллов для расчёта места
    $playersWithScore = Player::select('players.*')
        ->leftJoin('game_player', 'players.id', '=', 'game_player.player_id')
        ->selectRaw('COALESCE(SUM(game_player.score), 0) as total_score')
        ->groupBy('players.id')
        ->orderByDesc('total_score')
        ->get();

    // Создаем карту: player_id => rank
    $rankMap = [];
    foreach ($playersWithScore as $index => $player) {
        $rankMap[$player->id] = $index + 1;
    }

    // Получаем ВСЕХ игроков (без пагинации) с играми
    $players = Player::with('games')
        ->orderBy('name', 'asc')
        ->get(); // ← get(), а не paginate()

    return view('players.index', compact('players', 'rankMap'));
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('players')->where(function ($query) {
                    return $query->whereRaw('LOWER(name) = ?', [strtolower(request('name'))]);
                }),
            ],
        ], [
            'name.unique' => 'Игрок с таким именем уже существует.',
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('players')->ignore($player->id)->where(function ($query) {
                    return $query->whereRaw('LOWER(name) = ?', [strtolower(request('name'))]);
                }),
            ],
        ], [
            'name.unique' => 'Игрок с таким именем уже существует.',
        ]);

        $player->update($validated);

        return redirect()->route('players.index')->with('success', 'Игрок успешно обновлён');
    }

    public function destroy(Player $player)
    {
        $this->authorize('delete', $player);
        if ($player->games()->exists()) {
            return redirect()->route('players.index')->with('error', 'Игрок не может быть удалён, так как он участвует в одной или более играх');
        }

        $player->delete();

        return redirect()->route('players.index')->with('success', 'Игрок успешно удалён');
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

// app/Http/Controllers/PlayerController.php

public function show(Player $player)
{
    // Загружаем игры игрока (с pivot-данными)
    $player->load('games');

    // Собираем все role_id из pivot
    $roleIds = $player->games->pluck('pivot.role_id')->filter()->unique();

    // Загружаем соответствующие роли одним запросом
    $roles = Role::whereIn('id', $roleIds)->get()->keyBy('id');

    return view('players.show', compact('player', 'roles'));
}
}