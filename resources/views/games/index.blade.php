@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-2" x-data="{ openModal: false, game: null }">
    <h1 class="text-2xl font-bold mb-6 text-center text-zinc-800">Список игр</h1>

    @can('create', App\Models\Game::class)
    <div class="flex justify-end mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-controller" viewBox="0 0 16 16">
                <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
                <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
            </svg>
            <span>Создать игру</span>
        </a>
    </div>
    @endcan

    <!-- Обертка для таблицы -->
    <div class="overflow-x-auto rounded-lg shadow-lg bg-zinc-200">
        <table class="table-fixed border-collapse w-full text-xs">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-20 px-1.5 py-2 text-center">Дата</th>
                    <th class="border border-zinc-500 w-8 px-1.5 py-2 text-center">№</th>
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
                    <td class="border border-zinc-500 w-8 px-1.5 py-2 text-center text-zinc-700">
                        {{ $game->game_number }}
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
                                            name: '{{ addslashes($player->name) }}',
                                            role: '{{ addslashes($player->role->name ?? '—') }}',
                                            best_player: {{ $player->best_player ? 'true' : 'false' }},
                                            first_victim: {{ $player->first_victim ? 'true' : 'false' }},
                                            additional_score: {{ $player->additional_score ? 'true' : 'false' }}
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
                            <!-- Кнопка редактирования -->
                            <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 text-white text-[10px] py-0.5 px-1.5 rounded hover:bg-yellow-600 transition whitespace-nowrap flex items-center justify-center w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 1 1-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <!-- Кнопка удаления -->
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

    <!-- Модальное окно -->
    <div x-show="openModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click="openModal = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click.stop 
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 mx-4 max-h-96 overflow-y-auto transform transition-all"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="scale-100 opacity-100"
             x-transition:leave-end="scale-95 opacity-0">
            <h3 class="text-xl font-bold text-zinc-800 mb-4">
                <span x-text="game?.name"></span>
                <span class="text-sm font-normal text-zinc-600" x-text="game?.date"></span>
            </h3>

            <div class="space-y-3">
                <h4 class="font-semibold text-zinc-700">Список игроков (<span x-text="game?.players?.length || 0"></span>):</h4>
                
                <template x-if="game?.players && game.players.length > 0">
                    <ul class="mt-2 space-y-2">
                        <template x-for="(player, index) in game.players" :key="player.id">
                            <li class="p-2 bg-zinc-50 rounded animate-fade-in"
                                :style="`animation-delay: ${index * 0.1}s`">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-zinc-800" x-text="index + 1"></span>
                                        <span class="text-sm text-zinc-700" x-text="player.name"></span>
                                        <span class="text-xs text-zinc-500 bg-zinc-200 px-2 py-0.5 rounded" x-text="player.role"></span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <template x-if="player.best_player">
                                            <span class="text-yellow-500 font-bold" title="Лучший игрок">🌟</span>
                                        </template>
                                        <template x-if="player.first_victim">
                                            <span class="text-red-500 font-bold" title="Первая кровь">💉</span>
                                        </template>
                                        <template x-if="player.additional_score">
                                            <span class="text-green-500 font-bold" title="Доп. баллы">➕</span>
                                        </template>
                                    </div>
                                </div>
                            </li>
                        </template>
                    </ul>
                </template>
                
                <template x-if="!game?.players || game.players.length === 0">
                    <p class="text-zinc-500 text-sm">Нет игроков в этой игре.</p>
                </template>
            </div>

            <button @click="openModal = false"
                    class="mt-6 w-full py-3 bg-gradient-to-r from-zinc-800 to-zinc-700 text-white rounded-xl hover:from-zinc-700 hover:to-zinc-600 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 active:scale-95">
                Закрыть
            </button>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateX(-10px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
            opacity: 0;
        }
    </style>
</div>
@endsection