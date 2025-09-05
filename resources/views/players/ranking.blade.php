@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок -->
    <h1 class="text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <!-- Обёртка с горизонтальным скроллом -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <!-- Таблица с фиксированной шириной -->
        <table class="table-fixed border-collapse w-full bg-zinc-700 text-zinc-100">
            <thead class="bg-zinc-800 text-zinc-100 sticky top-0 z-10 uppercase text-sm">
                <tr>
                    <th class="border border-zinc-500 w-12 px-4 py-3 text-center">№</th>
                    <th class="border border-zinc-500 px-4 py-3 text-left" style="width: 300px;">Игрок</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center font-bold text-pink-300">Р</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-blue-300">И</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-green-300">П</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-orange-300">БЛ</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-purple-300">ПУ</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-red-300">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-600">
                @foreach($players as $player)
                <tr>
                    <!-- Место -->
                    <td class="border border-zinc-500 w-12 px-4 py-2 text-center text-sm">
                        @if($loop->iteration <= 3)
                            <span class="font-bold">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-300">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока (всегда в одну строку) -->
                    <td class="border border-zinc-500 px-4 py-2 text-left whitespace-nowrap" style="width: 300px;">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                @if($loop->iteration == 1)
                                    font-semibold text-amber-200
                                @elseif($loop->iteration == 2)
                                    font-semibold text-gray-100
                                @elseif($loop->iteration == 3)
                                    font-semibold text-orange-200
                                @else
                                    text-zinc-100
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Рейтинг (Р) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center font-bold text-lg text-pink-300">
                        {{ $player->games->sum('pivot.score') }}
                    </td>
                    <!-- Игры (И) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center text-blue-300">{{ $player->total_games }}</td>
                    <!-- Победы (П) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center text-green-300">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <!-- Был лучшим (БЛ) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center text-orange-300">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <!-- Первым убит (ПУ) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center text-purple-300">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <!-- Доп. баллы (ДБ) -->
                    <td class="border border-zinc-500 w-16 px-4 py-2 text-center text-red-300">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection