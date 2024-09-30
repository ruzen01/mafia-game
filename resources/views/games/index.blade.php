@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Список игр</h1>

    <!-- Ссылка на создание новой игры -->
    <div class="flex justify-center mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Создать новую игру
        </a>
    </div>

    <!-- Таблица со списком игр -->
    <div class="overflow-x-auto">
        <table class="table-auto border-collapse border border-gray-500 w-full">
            <thead class="text-left">
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Дата</th>
                    <th class="border border-gray-400 px-4 py-2">Имя</th>
                    <th class="border border-gray-400 px-4 py-2 w-20">№</th>
                    <th class="border border-gray-400 px-4 py-2">Ведущий</th>
                    <th class="border border-gray-400 px-4 py-2">Сезон</th>
                    <th class="border border-gray-400 px-4 py-2">Победитель</th>
                    <th class="border border-gray-400 px-4 py-2">Игроки</th>
                    <th class="border border-gray-400 px-4 py-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">
                        <a href="{{ route('games.show', $game->id) }}" class="text-white hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-gray-400 px-4 py-2 text-left w-20 whitespace-nowrap overflow-hidden text-ellipsis">{{ $game->game_number }}</td>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $game->host_name }}</td>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $game->season }}</td>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $game->winner }}</td>
                    <td class="border border-gray-400 px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis max-w-xs">
                        @if ($game->players)
                            {{ $game->players->pluck('name')->implode(', ') }}
                        @else
                            Игроки не указаны
                        @endif
                    </td>
                    <td class="border border-gray-400 px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">
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