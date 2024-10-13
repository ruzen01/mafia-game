@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    @if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-center text-4xl font-extrabold text-gray-800 mb-6">Список игр</h1> <!-- Увеличил размер заголовка и сделал его темнее -->

    @can('create', App\Models\Game::class)
    <div class="flex justify-right mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 shadow-lg shadow-blue-500/5 hover:bg-blue-300 text-white py-2 px-4 rounded">
            Создать новую игру
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-auto w-full">
            <thead class="bg-gray-300 text-gray-900 text-left"> <!-- Темнее для заголовков таблицы -->
                <tr>
                    <th class="truncate px-4 py-2">Дата</th>
                    <th class="truncate px-4 py-2">Имя</th>
                    <th class="truncate px-4 py-2">№</th>
                    <th class="truncate px-4 py-2">Ведущий</th>
                    <th class="truncate px-4 py-2">Сезон</th>
                    <th class="truncate px-4 py-2">Победитель</th>
                    <th class="truncate px-4 py-2">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="truncate px-4 py-2">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300"> <!-- Чередующиеся строки с легким выделением при наведении -->
                    <td class="truncate px-4 py-2">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="truncate max-w-xs px-4 py-2">
                        <a href="{{ route('games.show', $game->id) }}" class="hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="truncate px-4 py-2">{{ $game->game_number }}</td>
                    <td class="truncate px-4 py-2">{{ $game->host_name }}</td>
                    <td class="truncate px-4 py-2">{{ $game->season }}</td>
                    <td class="truncate px-4 py-2">{{ $game->winner }}</td>
                    <td class="truncate px-4 py-2">
                        <div class="flex -space-x-2">
                            @foreach($game->players->take(5) as $player)
                            @php
                            // Получение инициалов
                            $initials = strtoupper(substr($player->name, 0, 1));
                            if (str_contains($player->name, ' ')) {
                            $initials .= strtoupper(substr(explode(' ', $player->name)[1], 0, 1));
                            }
                            @endphp
                            <div class="relative group flex items-center justify-center text-white font-bold w-6 h-6 rounded-full bg-blue-500">
                                {{ $initials }}
                                <span class="absolute bottom-12 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    {{ $player->name }}
                                </span>
                            </div>
                            @endforeach

                            @if($game->players->count() > 5)
                            <span class="text-gray-700 text-xs font-bold ml-4">
                                +{{ $game->players->count() - 5 }}
                            </span>
                            @endif
                        </div>
                    </td>
                    @can('update', [$game])
                    <td class="truncate px-4 py-2">
                        <form action="{{ route('games.edit', $game->id) }}" method="GET" style="display:inline-block;">
                            <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-400">Изменить</button>
                        </form>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-400" onclick="return confirm('Вы уверены, что хотите удалить эту игру?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection