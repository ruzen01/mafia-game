@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Подробная информация об игре: {{ $game->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <!-- Основная информация об игре в таблице -->
        <table class="table-auto border-collapse border border-gray-500 w-full mb-6">
            <tbody>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Дата игры:</th>
                    <td class="border border-gray-400 px-4 py-2">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Номер игры:</th>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->game_number }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Ведущий:</th>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->host_name }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Сезон:</th>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->season }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Победитель:</th>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->winner }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Игроки и их баллы в таблице -->
        <h3 class="text-lg font-semibold mb-2">Игроки и их баллы:</h3>
        <table class="table-auto border-collapse border border-gray-500 w-full">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Имя игрока</th>
                    <th class="border border-gray-400 px-4 py-2">Баллы</th>
                    <th class="border border-gray-400 px-4 py-2">Лучший игрок</th>
                    <th class="border border-gray-400 px-4 py-2">Первая жертва</th>
                    <th class="border border-gray-400 px-4 py-2">Баллы от ведущего</th>
                    <th class="border border-gray-400 px-4 py-2">Доп. балл</th>
                    <th class="border border-gray-400 px-4 py-2">Комментарий</th>
                </tr>
            </thead>
            <tbody>
                @foreach($game->players as $player)
                <tr>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->name }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->score }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->best_player ? 'Да' : 'Нет' }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->first_victim ? 'Да' : 'Нет' }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->leader_score }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->additional_score ? 'Да' : 'Нет' }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $player->pivot->comment ?? 'Нет' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Кнопки для редактирования и удаления игры -->
    <div class="flex justify-between">
        <a href="{{ route('games.edit', $game) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition duration-300">
            Изменить
        </a>

        <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить игру?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-300">
                Удалить
            </button>
        </form>
    </div>
</div>
@endsection