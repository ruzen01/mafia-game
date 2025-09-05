@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-white">Рейтинг игроков</h1>
    <div class="overflow-auto max-h-screen rounded-lg shadow-xl">
        <table class="table-auto border-collapse border border-gray-700 w-full bg-gray-800 text-white rounded-lg">
            <thead class="sticky top-0 z-20">
                <tr class="bg-gradient-to-r from-gray-900 to-gray-800 text-gray-200 uppercase text-sm">
                    <th class="border border-gray-600 w-12 px-4 py-3 text-center">#</th>
                    <th class="border border-gray-600 w-full px-4 py-3 text-left">Игрок</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center font-bold text-pink-400">Р</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center text-blue-400">И</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center text-green-400">П</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center text-orange-400">БЛ</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center text-purple-400">ПУ</th>
                    <th class="border border-gray-600 w-16 px-4 py-3 text-center text-red-400">ДБ</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($players as $player)
                <tr class="
                    @if($loop->iteration <= 10)
                        bg-gray-750 hover:bg-gray-700
                    @else
                        hover:bg-gray-750
                    @endif
                    transition duration-150 ease-in-out
                ">
                    <!-- Место с медалью -->
                    <td class="border border-gray-600 w-12 px-4 py-2 text-center text-lg">
                        @if($loop->iteration <= 3)
                            <span class="font-bold">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-gray-300">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока — глянцевые блоки для топ-3 -->
                    <td class="border border-gray-600 w-full px-4 py-2 text-left">
                        <a href="{{ route('players.show', $player->id) }}" 
                           class="
                                @if($loop->iteration <= 10) font-semibold @endif
                                @if($loop->iteration == 1)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-yellow-500 to-yellow-600 text-yellow-100 shadow-md font-bold transform hover:scale-105 transition
                                @elseif($loop->iteration == 2)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-gray-400 to-gray-500 text-gray-900 shadow-md font-bold transform hover:scale-105 transition
                                @elseif($loop->iteration == 3)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-orange-500 to-orange-600 text-orange-100 shadow-md font-bold transform hover:scale-105 transition
                                @else
                                    text-gray-200 hover:text-white hover:underline
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Столбец "Р" -->
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center font-bold text-lg text-pink-300">
                        {{ $player->games->sum('pivot.score') }}
                    </td>

                    <!-- Остальные столбцы -->
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center text-blue-300">{{ $player->total_games }}</td>
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center text-green-300">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center text-orange-300">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center text-purple-300">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <td class="border border-gray-600 w-16 px-4 py-2 text-center text-red-300">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Дополнительно: стили для полупрозрачного фона и плавности -->
<style>
    .bg-gray-750 {
        @apply bg-gray-750 bg-opacity-80;
    }
    .bg-gray-750 td {
        @apply transition-colors duration-150;
    }
</style>
@endsection