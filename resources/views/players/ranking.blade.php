@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок в тёмном стиле -->
    <h1 class="text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <div class="overflow-auto max-h-screen rounded-lg shadow-lg">
        <!-- Таблица с тёмной темой на фоне light zinc -->
        <table class="table-auto border-collapse border border-zinc-600 w-full bg-zinc-50 text-zinc-900 rounded-lg">
            <thead class="bg-zinc-700 text-zinc-100 sticky top-0 z-20 uppercase text-sm">
                <tr>
                    <th class="border border-zinc-500 w-12 px-4 py-3 text-center">#</th>
                    <th class="border border-zinc-500 w-full px-4 py-3 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center font-bold text-pink-300">Р</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-blue-300">И</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-green-300">П</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-orange-300">БЛ</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-purple-300">ПУ</th>
                    <th class="border border-zinc-500 w-16 px-4 py-3 text-center text-red-300">ДБ</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($players as $player)
                <tr class="
                    @if($loop->iteration <= 10)
                        bg-zinc-200 hover:bg-zinc-300
                    @else
                        hover:bg-zinc-100
                    @endif
                    transition duration-150 ease-in-out
                ">
                    <!-- Место с медалью -->
                    <td class="border border-zinc-400 w-12 px-4 py-2 text-center text-lg">
                        @if($loop->iteration <= 3)
                            <span class="font-bold">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-700">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока -->
                    <td class="border border-zinc-400 w-full px-4 py-2 text-left">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                @if($loop->iteration <= 10) font-semibold @endif
                                @if($loop->iteration == 1)
                                    px-3 py-1 rounded bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-900 font-medium
                                @elseif($loop->iteration == 2)
                                    px-3 py-1 rounded bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-medium
                                @elseif($loop->iteration == 3)
                                    px-3 py-1 rounded bg-gradient-to-r from-orange-100 to-orange-200 text-orange-900 font-medium
                                @else
                                    text-zinc-800 hover:text-zinc-900 hover:underline
                                @endif
                           ">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Р — Рейтинг -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center font-bold text-lg text-pink-700">
                        {{ $player->games->sum('pivot.score') }}
                    </td>

                    <!-- И — Игры -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center text-blue-700">{{ $player->total_games }}</td>
                    <!-- П — Победы -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center text-green-700">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <!-- БЛ — Был лучшим -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center text-orange-700">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <!-- ПУ — Первым убит -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center text-purple-700">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <!-- ДБ — Доп. баллы -->
                    <td class="border border-zinc-400 w-16 px-4 py-2 text-center text-red-700">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection