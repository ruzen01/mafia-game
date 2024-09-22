@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-3xl mb-6">Список игр</h1>

    <!-- Ссылка на создание новой игры -->
    <div class="flex justify-center mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">
            Создать новую игру
        </a>
    </div>

    <!-- Таблица со списком игр -->
    <div class="flex justify-center">
        <table class="table-auto border-collapse border border-gray-500 w-3/4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-400 px-4 py-2">Имя</th>
                    <th class="border border-gray-400 px-4 py-2">Дата</th>
                    <th class="border border-gray-400 px-4 py-2">Номер игры</th>
                    <th class="border border-gray-400 px-4 py-2">Ведущий</th>
                    <th class="border border-gray-400 px-4 py-2">Победитель</th>
                    <th class="border border-gray-400 px-4 py-2">Игроки</th>
                    <th class="border border-gray-400 px-4 py-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <!-- Ссылка на страницу с подробной информацией об игре -->
                    <td class="border border-gray-400 px-4 py-2">
                        <a href="{{ route('games.show', $game->id) }}" class="text-blue-500 underline">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->date }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->game_number }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->host_name }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $game->winner }}</td>
                    <td class="border border-gray-400 px-4 py-2">
                        @if ($game->players)
                        {{ $game->players->pluck('name')->implode(', ') }}
                        @else
                        Игроки не указаны
                        @endif
                    </td>
                    <td class="border border-gray-400 px-4 py-2">
                        <!-- Кнопка редактирования игры -->
                        <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 text-white py-1 px-2 rounded">
                            Изменить
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection