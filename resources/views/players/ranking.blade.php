@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Рейтинг игроков</h1>
    <div class="overflow-auto max-h-screen rounded-lg shadow-lg">
        <table class="table-auto border-collapse border border-gray-400 w-full">
            <thead class="bg-gray-300 text-white sticky top-0 z-20">
                <tr>
                    <th class="border border-gray-300 w-12 px-4 py-2 text-gray-500 text-center">#</th>
                    <th class="border border-gray-300 w-full px-4 py-2 text-gray-800 text-left">Игрок</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-pink-600 text-center font-bold text-lg">Р</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-blue-500 text-center">И</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-green-500 text-center">П</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-orange-500 text-center">БЛ</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-purple-500 text-center">ПУ</th>
                    <th class="border border-gray-300 w-16 px-4 py-2 text-red-500 text-center">ДБ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                <tr class="
                    @if($loop->iteration <= 10)
                        bg-emerald-50
                    @else
                        bg-white
                    @endif
                ">
                    <!-- Место с медалью -->
                    <td class="border border-gray-300 w-12 px-4 py-1 text-center">
                        @if($loop->iteration <= 3)
                            <span class="font-bold text-lg">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-gray-700">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока — глянцевые блоки для топ-3 -->
                    <td class="border border-gray-300 w-full px-4 py-1 text-left">
                        <a href="{{ route('players.show', $player->id) }}" 
                           class="
                                @if($loop->iteration <= 10) font-semibold @endif
                                @if($loop->iteration == 1)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-yellow-300 to-yellow-500 text-yellow-900 shadow-sm font-bold
                                @elseif($loop->iteration == 2)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-gray-200 to-gray-300 text-gray-800 shadow-sm font-bold
                                @elseif($loop->iteration == 3)
                                    px-3 py-1 rounded-md bg-gradient-to-r from-orange-200 to-orange-400 text-orange-900 shadow-sm font-bold
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Столбец "Р" -->
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center font-bold text-lg text-pink-700">
                        {{ $player->games->sum('pivot.score') }}
                    </td>

                    <!-- Остальные столбцы -->
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center text-blue-600">{{ $player->total_games }}</td>
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center text-green-600">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center text-orange-600">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center text-purple-600">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <td class="border border-gray-300 w-16 px-4 py-1 text-center text-red-600">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection