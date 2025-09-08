@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-2" x-data="{ openModal: false, game: null }">
    <h1 class="text-2xl font-bold mb-6 text-center text-zinc-800">Список игр</h1>

    @can('create', App\Models\Game::class)
    <div class="flex justify-end mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded font-semibold transition transform hover:scale-105 shadow-md">
            🎮 Создать игру
        </a>
    </div>
    @endcan

    <!-- Обертка для таблицы -->
    <div class="overflow-x-auto rounded-lg shadow-lg bg-zinc-200">
        <table class="table-fixed border-collapse w-full text-xs">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-20 px-1.5 py-2 text-center">Дата</th>
                    <th class="border border-zinc-500 w-36 px-1.5 py-2 text-left">Имя игры</th>
                    <th class="border border-zinc-500 w-8 px-1.5 py-2 text-center">№</th>
                    <th class="border border-zinc-500 w-24 px-1.5 py-2 text-center">Ведущий</th>
                    <th class="border border-zinc-500 w-12 px-1.5 py-2 text-center">Сезон</th>
                    <th class="border border-zinc-500 w-24 px-1.5 py-2 text-center">Победитель</th>
                    <th class="border border-zinc-500 w-16 px-1.5 py-2 text-center">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="border border-zinc-500 w-28 px-1.5 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($games as $game)
                <tr class="bg-zinc-200">
                    <td class="border border-zinc-500 w-20 px-1.5 py-2 text-center text-zinc-700 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                    </td>
                    <td class="border border-zinc-500 w-36 px-1.5 py-2 text-left">
                        <a href="{{ route('games.show', $game->id) }}" class="block truncate font-semibold text-zinc-800 hover:text-blue-600 hover:underline" title="{{ $game->name }}">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-zinc-500 w-8 px-1.5 py-2 text-center text-zinc-700">
                        {{ $game->game_number }}
                    </td>
                    <td class="border border-zinc-500 w-24 px-1.5 py-2 text-center text-zinc-700 truncate" title="{{ $game->host_name }}">
                        {{ $game->host_name }}
                    </td>
                    <td class="border border-zinc-500 w-12 px-1.5 py-2 text-center text-zinc-700">
                        {{ $game->season }}
                    </td>
                    <td class="border border-zinc-500 w-24 px-1.5 py-2 text-center text-zinc-700 truncate" title="{{ $game->winner }}">
                        {{ $game->winner }}
                    </td>
                    <td class="border border-zinc-500 w-16 px-1.5 py-2 text-center">
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
                            class="bg-blue-500 hover:bg-blue-600 text-white text-[10px] py-0.5 px-1.5 rounded transition transform hover:scale-105 whitespace-nowrap"
                        >
                            {{ $game->players->count() }}
                        </button>
                        @else
                        <span class="text-zinc-500 text-[10px] whitespace-nowrap">0</span>
                        @endif
                    </td>
                    @can('update', [$game])
                    <td class="border border-zinc-500 w-28 px-1.5 py-2 text-center">
                        <div class="flex justify-center space-x-1">
                            <!-- Кнопка редактирования с SVG иконкой -->
                            <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 text-white text-[10px] py-0.5 px-1.5 rounded hover:bg-yellow-600 transition whitespace-nowrap flex items-center justify-center w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <!-- Кнопка удаления с SVG иконкой -->
                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white text-[10px] py-0.5 px-1.5 rounded hover:bg-red-600 transition whitespace-nowrap flex items-center justify-center w-6 h-6" onclick="return confirm('Удалить?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
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

    <!-- Модальное окно (без изменений) -->
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
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold" x-text="player.name.substring(0, 1).toUpperCase()"></span>
                                </div>
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