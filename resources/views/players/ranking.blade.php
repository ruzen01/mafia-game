@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок -->
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <!-- Обёртка с горизонтальным скроллом -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <!-- Таблица с фиксированной шириной -->
        <table class="table-fixed border-collapse w-full bg-zinc-600 text-zinc-100 text-sm">
            <thead class="bg-zinc-800 text-zinc-100 uppercase text-xs">
                <tr>
                    <th class="border border-zinc-500 w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 px-2 py-2 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-pink-300 font-bold">Р</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-blue-300">И</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-green-300">П</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-orange-300">БЛ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-purple-300">ПУ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-red-300">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($players as $player)
                <tr>
                    <!-- Место -->
                    <td class="border border-zinc-500 w-8 px-1 py-1 text-center">
                        @if($loop->iteration <= 3)
                            <span class="font-bold text-sm">{{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}</span>
                        @else
                            <span class="text-zinc-300 text-sm">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока — обрезается с ... -->
                    <td class="border border-zinc-500 px-2 py-1 min-w-0">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                block truncate
                                @if($loop->iteration == 1) text-amber-200 font-semibold
                                @elseif($loop->iteration == 2) text-gray-100 font-semibold
                                @elseif($loop->iteration == 3) text-orange-200 font-semibold
                                @else text-zinc-100
                                @endif
                           "
                           title="{{ $player->name }}">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Рейтинг -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center font-bold text-pink-300">{{ $player->games->sum('pivot.score') }}</td>
                    <!-- Игры -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-blue-300">{{ $player->total_games }}</td>
                    <!-- Победы -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-green-300">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <!-- Был лучшим -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-orange-300">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <!-- Первым убит -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-purple-300">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <!-- Доп. баллы -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-red-300">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection