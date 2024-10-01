@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок страницы -->
    <h1 class="text-center text-3xl font-bold mb-6">Подробная информация об игре: {{ $game->name }}</h1>

    <!-- Основная информация об игре в таблице -->
    <div class="shadow-md rounded-lg p-6 mb-6">
        <table class="table-auto border-collapse border border-gray-300 w-full mb-6">
            <tbody>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Дата игры:</th>
                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Номер игры:</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $game->game_number }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Ведущий:</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $game->host_name }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Сезон:</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $game->season }}</td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Победитель:</th>
                    <td class="border border-gray-300 px-4 py-2">{{ $game->winner }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Таблица игроков и их результатов -->
        <h3 class="text-xl font-semibold mb-4">Игроки и их баллы:</h3>
        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-gray-300 w-full text-sm">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Имя игрока</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Роль</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Баллы</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Лучший игрок</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Первая жертва</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Баллы от ведущего</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Доп. балл</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Комментарий</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($game->players as $player)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $player->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $player->pivot->role }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $player->pivot->score }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $player->pivot->best_player ? 'Да' : 'Нет' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $player->pivot->first_victim ? 'Да' : 'Нет' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $player->pivot->leader_score }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $player->pivot->additional_score ? 'Да' : 'Нет' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $player->pivot->comment ?? 'Нет' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Кнопки для редактирования и удаления игры -->
    <div class="flex justify-between mt-6">
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