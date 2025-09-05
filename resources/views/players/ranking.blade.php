@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок в тёмных тонах -->
    <h1 class="text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <div class="overflow-auto max-h-screen rounded-lg shadow-lg">
        <!-- Таблица с фиксированной шириной столбцов -->
        <table class="table-fixed border-collapse border border-zinc-600 w-full bg-zinc-900 text-zinc-100 rounded-lg">
            <thead class="bg-zinc-800 text-zinc-200 sticky top-0 z-20 uppercase text-sm">
                <tr>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center">№</th>
                    <th class="border border-zinc-500 w-5/12 px-4 py-3 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center font-bold text-pink-300">Р</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center text-blue-300">И</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center text-green-300">П</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center text-orange-300">БЛ</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center text-purple-300">ПУ</th>
                    <th class="border border-zinc-500 w-1/12 px-4 py-3 text-center text-red-300">ДБ</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($players as $player)
                <tr class="
                    @if($loop->iteration <= 10)
                        bg-zinc-800 hover:bg-zinc-700
                    @else
                        hover:bg-zinc-750
                    @endif
                    transition duration-150 ease-in-out
                ">
                    <!-- Место с медалью -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-lg">
                        @if($loop->iteration <= 3)
                            <span class="font-bold">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-300">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока -->
                    <td class="border border-zinc-600 w-5/12 px-4 py-2 text-left">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                @if($loop->iteration <= 10) font-semibold @endif
                                @if($loop->iteration == 1)
                                    px-3 py-1 rounded bg-gradient-to-r from-amber-500/20 to-yellow-500/20 text-amber-100 font-medium
                                @elseif($loop->iteration == 2)
                                    px-3 py-1 rounded bg-gradient-to-r from-gray-400/20 to-gray-500/20 text-gray-100 font-medium
                                @elseif($loop->iteration == 3)
                                    px-3 py-1 rounded bg-gradient-to-r from-orange-500/20 to-orange-600/20 text-orange-100 font-medium
                                @else
                                    text-zinc-200 hover:text-white hover:underline
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Рейтинг (Р) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center font-bold text-lg text-pink-300">
                        {{ $player->games->sum('pivot.score') }}
                    </td>

                    <!-- Игры (И) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-blue-300">{{ $player->total_games }}</td>
                    <!-- Победы (П) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-green-300">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <!-- Был лучшим (БЛ) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-orange-300">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <!-- Первым убит (ПУ) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-purple-300">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <!-- Доп. баллы (ДБ) -->
                    <td class="border border-zinc-600 w-1/12 px-4 py-2 text-center text-red-300">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection