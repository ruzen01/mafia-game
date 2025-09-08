@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6" x-data="{ openModal: false, game: null }">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Список игр</h1>

    @can('create', App\Models\Game::class)
    <div class="flex justify-end mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition transform hover:scale-105 shadow-md">
            🎮 Создать новую игру
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-200 text-xs sm:text-sm">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-20 px-1 py-2 text-center">Дата</th>
                    <th class="border border-zinc-500 px-1 sm:px-2 py-2 text-left">Имя игры</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 w-24 px-1 py-2 text-center">Ведущий</th>
                    <th class="border border-zinc-500 w-16 px-1 py-2 text-center">Сезон</th>
                    <th class="border border-zinc-500 w-24 px-1 py-2 text-center">Победитель</th>
                    <th class="border border-zinc-500 w-16 px-1 py-2 text-center">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="border border-zinc-500 w-28 px-1 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($games as $game)
                <tr class="bg-zinc-200 animate-fade-in" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                    <td class="border border-zinc-500 w-20 px-1 py-1 text-center text-zinc-700">
                        {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                    </td>
                    <td class="border border-zinc-500 px-1 sm:px-2 py-1 min-w-0">
                        <a href="{{ route('games.show', $game->id) }}" class="block truncate font-semibold text-zinc-800 hover:text-blue-600 hover:underline" title="{{ $game->name }}">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-zinc-700">
                        {{ $game->game_number }}
                    </td>
                    <td class="border border-zinc-500 w-24 px-1 py-1 text-center text-zinc-700">
                        {{ $game->host_name }}
                    </td>
                    <td class="border border-zinc-500 w-16 px-1 py-1 text-center text-zinc-700">
                        {{ $game->season }}
                    </td>
                    <td class="border border-zinc-500 w-24 px-1 py-1 text-center text-zinc-700">
                        {{ $game->winner }}
                    </td>
                    <td class="border border-zinc-500 w-16 px-1 py-1 text-center">
                        @if($game->players->count() > 0)
                        <button 
                            @click="openModal = true; game = {
                                id: {{ $game->id }},
                                name: '{{ $game->name }}',
                                date: '{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}',
                                players: [
                                    @foreach($game->players as $player)
                                        {
                                            id: {{ $player->id }},
                                            name: '{{ addslashes($player->name) }}'
                                        }@if(!$loop->last),@endif
                                    @endforeach
                                ]
                            }"
                            class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-1 px-2 rounded transition transform hover:scale-105"
                        >
                            {{ $game->players->count() }}
                        </button>
                        @else
                        <span class="text-zinc-500 text-xs">0</span>
                        @endif
                    </td>
                    @can('update', [$game])
                    <td class="border border-zinc-500 w-28 px-1 py-1 text-center space-y-1">
                        <form action="{{ route('games.edit', $game->id) }}" method="GET" class="inline-block">
                            <button type="submit" class="bg-yellow-500 text-white text-xs py-1 px-2 rounded hover:bg-yellow-600 transition">
                                ✏️
                            </button>
                        </form>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs py-1 px-2 rounded hover:bg-red-600 transition" onclick="return confirm('Удалить игру {{ $game->name }}?')">
                                🗑️
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Модальное окно для отображения списка игроков -->
    <div x-show="openModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click.outside="openModal = false"
         x-transition.opacity>
        <div @click.outside="" class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 mx-4 max-h-96 overflow-y-auto">
            <h3 class="text-xl font-bold text-zinc-800 mb-4">
                <span x-text="game?.name"></span>
                <span class="text-sm font-normal text-zinc-600" x-text="game?.date"></span>
            </h3>

            <div class="space-y-3">
                <h4 class="font-semibold text-zinc-700">Список игроков (<span x-text="game?.players?.length || 0"></span>):</h4>
                
                <template x-if="game?.players && game.players.length > 0">
                    <ul class="mt-2 space-y-2">
                        <template x-for="player in game.players" :key="player.id">
                            <li class="flex items-center p-2 bg-zinc-100 rounded hover:bg-zinc-200 transition-colors">
                                <!-- Аватар или инициалы игрока -->
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">
                                        <template x-text="player.name.substring(0, 1).toUpperCase()"></template>
                                    </span>
                                </div>
                                <!-- Имя игрока -->
                                <span class="text-sm text-zinc-700" x-text="player.name"></span>
                            </li>
                        </template>
                    </ul>
                </template>
                
                <template x-if="!game?.players || game.players.length === 0">
                    <p class="text-zinc-500 text-sm">Нет игроков в этой игре.</p>
                </template>
            </div>

            <button @click="openModal = false"
                    class="mt-4 w-full py-2 bg-zinc-800 text-white rounded hover:bg-zinc-700 transition">
                Закрыть
            </button>
        </div>
    </div>

    <!-- Анимация появления -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
            opacity: 0;
        }
    </style>
</div>
@endsection