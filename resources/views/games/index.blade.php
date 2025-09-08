@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-1 sm:px-2" x-data="{ openModal: false, game: null }">
    <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-zinc-800">Список игр</h1>

    @can('create', App\Models\Game::class)
    <div class="flex justify-end mb-4">
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 sm:py-2 px-3 sm:px-4 rounded font-semibold transition transform hover:scale-105 shadow-md text-xs sm:text-sm">
            🎮 Создать
        </a>
    </div>
    @endcan

    <!-- Обертка для таблицы (прокрутка только на очень маленьких экранах) -->
    <div class="rounded-lg shadow-lg bg-zinc-200 overflow-x-auto sm:overflow-x-visible">
        <table class="table-fixed border-collapse w-full text-[10px] xs:text-xs sm:text-sm min-w-full">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-[10px] xs:text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-14 xs:w-16 px-1 py-2 text-center">Дата</th>
                    <th class="border border-zinc-500 w-28 xs:w-32 sm:w-40 px-1 py-2 text-left">Имя игры</th>
                    <th class="border border-zinc-500 w-6 xs:w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 w-16 xs:w-20 px-1 py-2 text-center">Ведущий</th>
                    <th class="border border-zinc-500 w-10 xs:w-12 px-1 py-2 text-center">Сезон</th>
                    <th class="border border-zinc-500 w-16 xs:w-20 px-1 py-2 text-center">Победитель</th>
                    <th class="border border-zinc-500 w-12 xs:w-14 px-1 py-2 text-center">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="border border-zinc-500 w-20 xs:w-24 px-1 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($games as $game)
                <tr class="bg-zinc-200 animate-fade-in" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                    <td class="border border-zinc-500 w-14 xs:w-16 px-1 py-2 text-center text-zinc-700 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                    </td>
                    <td class="border border-zinc-500 w-28 xs:w-32 sm:w-40 px-1 py-2 text-left">
                        <a href="{{ route('games.show', $game->id) }}" class="block truncate font-semibold text-zinc-800 hover:text-blue-600 hover:underline" title="{{ $game->name }}">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-zinc-500 w-6 xs:w-8 px-1 py-2 text-center text-zinc-700">
                        {{ $game->game_number }}
                    </td>
                    <td class="border border-zinc-500 w-16 xs:w-20 px-1 py-2 text-center text-zinc-700 truncate" title="{{ $game->host_name }}">
                        {{ $game->host_name }}
                    </td>
                    <td class="border border-zinc-500 w-10 xs:w-12 px-1 py-2 text-center text-zinc-700">
                        {{ $game->season }}
                    </td>
                    <td class="border border-zinc-500 w-16 xs:w-20 px-1 py-2 text-center text-zinc-700 truncate" title="{{ $game->winner }}">
                        {{ $game->winner }}
                    </td>
                    <td class="border border-zinc-500 w-12 xs:w-14 px-1 py-2 text-center">
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
                            class="bg-blue-500 hover:bg-blue-600 text-white text-[10px] xs:text-xs py-0.5 px-1.5 rounded transition transform hover:scale-105 whitespace-nowrap"
                        >
                            {{ $game->players->count() }}
                        </button>
                        @else
                        <span class="text-zinc-500 text-[10px] xs:text-xs whitespace-nowrap">0</span>
                        @endif
                    </td>
                    @can('update', [$game])
                    <td class="border border-zinc-500 w-20 xs:w-24 px-1 py-2 text-center space-y-0.5">
                        <div class="flex justify-center space-x-0.5">
                            <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 text-white text-[10px] xs:text-xs py-0.5 px-1.5 rounded hover:bg-yellow-600 transition whitespace-nowrap">
                                ✏️
                            </a>
                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white text-[10px] xs:text-xs py-0.5 px-1.5 rounded hover:bg-red-600 transition whitespace-nowrap" onclick="return confirm('Удалить игру?')">
                                    🗑️
                                </button>
                            </form>
                        </div>
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
        <div @click.outside="" class="bg-white rounded-lg shadow-xl max-w-md w-full p-4 sm:p-6 mx-2 sm:mx-4 max-h-96 overflow-y-auto">
            <h3 class="text-lg sm:text-xl font-bold text-zinc-800 mb-3 sm:mb-4">
                <span x-text="game?.name"></span>
                <span class="text-xs sm:text-sm font-normal text-zinc-600" x-text="game?.date"></span>
            </h3>

            <div class="space-y-2 sm:space-y-3">
                <h4 class="font-semibold text-zinc-700 text-sm">Список игроков (<span x-text="game?.players?.length || 0"></span>):</h4>
                
                <template x-if="game?.players && game.players.length > 0">
                    <ul class="mt-2 space-y-1">
                        <template x-for="player in game.players" :key="player.id">
                            <li class="flex items-center p-1.5 sm:p-2 bg-zinc-100 rounded hover:bg-zinc-200 transition-colors">
                                <!-- Аватар или инициалы игрока -->
                                <div class="flex-shrink-0 w-7 sm:w-8 h-7 sm:h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-2 sm:mr-3">
                                    <span class="text-white text-[10px] sm:text-xs font-bold">
                                        <template x-text="player.name.substring(0, 1).toUpperCase()"></template>
                                    </span>
                                </div>
                                <!-- Имя игрока -->
                                <span class="text-xs sm:text-sm text-zinc-700" x-text="player.name"></span>
                            </li>
                        </template>
                    </ul>
                </template>
                
                <template x-if="!game?.players || game.players.length === 0">
                    <p class="text-zinc-500 text-xs sm:text-sm">Нет игроков в этой игре.</p>
                </template>
            </div>

            <button @click="openModal = false"
                    class="mt-3 sm:mt-4 w-full py-1.5 sm:py-2 bg-zinc-800 text-white text-sm rounded hover:bg-zinc-700 transition">
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