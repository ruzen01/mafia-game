<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('host')->orderBy('date', 'desc')->get();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $players = User::all();
        return view('games.create', compact('players'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255', // Новое поле для названия игры
            'date' => 'required|date',
            'game_number' => 'required|integer',
            'host_id' => 'required|exists:players,id',
            'result' => 'required|string',
            'players' => 'required|array',
            'players.*.player_id' => 'nullable|exists:players,id', // Теперь может быть null, если пользователь введен вручную
            'players.*.custom_name' => 'nullable|string|max:255', // Пользователь может быть добавлен вручную
            'players.*.role' => 'required|string',
            'players.*.total_points' => 'required|integer',
            'players.*.additional_points' => 'required|integer',
            'players.*.best_player' => 'nullable|boolean',
            'players.*.first_victim' => 'nullable|boolean',
            'players.*.from_host_points' => 'required|integer',
            'players.*.comment' => 'nullable|string',
        ]);

        DB::beginTransaction(); // Начало транзакции

        try {
            // Создание игры
            $game = Game::create([
                'name' => $validatedData['game_name'], // Сохранение названия игры
                'date' => $validatedData['date'],
                'game_number' => $validatedData['game_number'],
                'host_id' => $validatedData['host_id'],
                'result' => $validatedData['result'],
            ]);

            // Привязка игроков к игре
            foreach ($validatedData['players'] as $playerData) {
                $gamePlayerData = [
                    'role' => $playerData['role'],
                    'total_points' => $playerData['total_points'],
                    'additional_points' => $playerData['additional_points'],
                    'best_player' => isset($playerData['best_player']),
                    'first_victim' => isset($playerData['first_victim']),
                    'from_host_points' => $playerData['from_host_points'],
                    'comment' => $playerData['comment'] ?? '',
                ];

                // Если участник выбран из зарегистрированных пользователей
                if (isset($playerData['player_id'])) {
                    $game->players()->attach($playerData['player_id'], $gamePlayerData);
                } else {
                    // Если введено имя вручную
                    $gamePlayerData['custom_name'] = $playerData['custom_name'];
                    $game->players()->create($gamePlayerData); // Создаем запись вручную
                }
            }

            DB::commit(); // Завершение транзакции
            return redirect()->route('games.index')->with('success', 'Игра успешно добавлена!');
        } catch (\Exception $e) {
            DB::rollBack(); // Откат транзакции в случае ошибки
            Log::error('Ошибка при создании игры: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ошибка при сохранении игры. Пожалуйста, попробуйте еще раз.');
        }
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