<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Game;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
    // Загружаем игроков вместе с их играми и делаем пагинацию на 10 игроков
    $players = Player::with('games')->paginate(15);

        return view('players.index', compact('players'));
    }

    public function create()
    {
        $games = Game::all(); // Получаем все игры для выбора
        return view('players.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Создаем игрока без привязки к игре
        $player = Player::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('players.index')->with('success', 'Игрок успешно создан');
    }

    public function edit(Player $player)
    {
        $games = Game::all(); // Получаем все игры для выбора
        return view('players.edit', compact('player', 'games'));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $player->update($validated);

        return redirect()->route('players.index')->with('success', 'Игрок успешно обновлен');
    }

    public function destroy(Player $player)
    {
        // Проверяем, есть ли игры у данного игрока
        if ($player->games()->exists()) {
            return redirect()->route('players.index')->with('error', 'Игрок не может быть удален, так как он участвует в одной или более играх');
        }
    
        // Если игр нет, удаляем игрока
        $player->delete();
    
        return redirect()->route('players.index')->with('success', 'Игрок успешно удален');
    }

    public function ranking()
    {
        // Получаем всех игроков с их данными, отсортированными по общему количеству баллов
        $players = Player::with('games')
            ->get()
            ->sortByDesc('total_points');
    
        // Отправляем данные на представление
        return view('players.ranking', compact('players'));
    }
}
