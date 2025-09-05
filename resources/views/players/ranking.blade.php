@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок -->
    <h1 class="text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <!-- Обёртка для горизонтального скролла (на узких экранах) -->
    <div class="overflow-x-auto rounded-lg shadow-md">
        <!-- Таблица с фиксированной шириной столбцов -->
        <table class="table-fixed border-collapse w-full bg-white text-zinc-900">
            <thead class="bg-zinc-100 text-zinc-700 sticky top-0 z-10">
                <tr>
                    <th class="border-b border-zinc-300 w-12 px-4 py-3 text-center">#</th>
                    <th class="border-b border-zinc-300 px-4 py-3 text-left" style="width: 300px;">Игрок</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-pink-600 font-bold">Р</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-blue-600">И</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-green-600">П</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-orange-600">БЛ</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-purple-600">ПУ</th>
                    <th class="border-b border-zinc-300 w-16 px-4 py-3 text-center text-red-600">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @foreach($players as $player)
                <tr class="
                    @if($loop->iteration <= 10)
                        bg-zinc-50 font-medium
                    @else
                        hover:bg-zinc-50
                    @endif
                    transition duration-75
                ">
                    <!-- Место -->
                    <td class="border-b border-zinc-200 w-12 px-4 py-2 text-center text-sm">
                        @if($loop->iteration <= 3)
                            <span class="font-bold">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-600">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока (всегда в одну строку) -->
                    <td class="border-b border-zinc-200 px-4 py-2 text-left whitespace-nowrap" style="width: 300px;">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                @if($loop->iteration == 1)
                                    text-amber-700 hover:text-amber-800 font-semibold
                                @elseif($loop->iteration == 2)
                                    text-gray-700 hover:text-gray-800 font-semibold
                                @elseif($loop->iteration == 3)
                                    text-orange-700 hover:text-orange-800 font-semibold
                                @else
                                    text-zinc-800 hover:text-zinc-900 hover:underline
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Рейтинг -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center font-bold text-lg text-pink-700">
                        {{ $player->games->sum('pivot.score') }}
                    </td>
                    <!-- Игры -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center text-blue-700">{{ $player->total_games }}</td>
                    <!-- Победы -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center text-green-700">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <!-- Был лучшим -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center text-orange-700">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <!-- Первым убит -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center text-purple-700">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <!-- Доп. баллы -->
                    <td class="border-b border-zinc-200 w-16 px-4 py-2 text-center text-red-700">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection