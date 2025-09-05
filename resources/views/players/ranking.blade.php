@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок -->
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <!-- Обёртка с горизонтальным скроллом -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-600 text-zinc-100 text-sm">
            <thead class="bg-zinc-800 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 px-2 py-2 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-amber-400">Р</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-slate-300">И</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-green-400">П</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-blue-400">БЛ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-red-500">ПУ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-purple-400">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($players as $player)
                <tr>
                    <!-- Место -->
                    <td class="border border-zinc-500 w-8 px-1 py-1 text-center">
                        @if($loop->iteration <= 3)
                            <span class="font-bold text-lg">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-300 text-sm">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока с цветами -->
                    @if($loop->iteration == 1)
                        <td class="border border-zinc-500 px-0 py-0 min-w-0 relative bg-gradient-to-r from-rose-900 via-rose-800 to-rose-900">
                            <div class="absolute inset-0 bg-gradient-to-b from-rose-300/30 to-transparent pointer-events-none rounded-sm"></div>
                            <a href="{{ route('players.show', $player->id) }}"
                               class="block truncate font-semibold text-rose-50 px-2 py-1 relative z-10 text-center sm:text-left"
                               title="{{ $player->name }}">
                                {{ $player->name }}
                            </a>
                        </td>
                    @elseif($loop->iteration == 2)
                        <td class="border border-zinc-500 px-0 py-0 min-w-0 relative bg-gradient-to-r from-purple-900 via-purple-800 to-purple-900">
                            <div class="absolute inset-0 bg-gradient-to-b from-purple-300/30 to-transparent pointer-events-none rounded-sm"></div>
                            <a href="{{ route('players.show', $player->id) }}"
                               class="block truncate font-semibold text-purple-50 px-2 py-1 relative z-10 text-center sm:text-left"
                               title="{{ $player->name }}">
                                {{ $player->name }}
                            </a>
                        </td>
                    @elseif($loop->iteration == 3)
                        <td class="border border-zinc-500 px-0 py-0 min-w-0 relative bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900">
                            <div class="absolute inset-0 bg-gradient-to-b from-indigo-300/30 to-transparent pointer-events-none rounded-sm"></div>
                            <a href="{{ route('players.show', $player->id) }}"
                               class="block truncate font-semibold text-indigo-50 px-2 py-1 relative z-10 text-center sm:text-left"
                               title="{{ $player->name }}">
                                {{ $player->name }}
                            </a>
                        </td>
@elseif($loop->iteration >= 4 && $loop->iteration <= 16)
    <td class="border border-zinc-500 px-2 py-1 min-w-0
        @switch($loop->iteration)
            @case(4) bg-teal-900 @break
            @case(5) bg-teal-800 @break
            @case(6) bg-teal-700 @break
            @case(7) bg-teal-600 @break
            @case(8) bg-teal-500 @break
            @case(9) bg-teal-500 @break
            @case(10) bg-teal-400 @break
            @case(11) bg-teal-400 @break
            @case(12) bg-teal-400 @break
            @case(13) bg-teal-400 @break
            @case(14) bg-teal-400 @break
            @case(15) bg-teal-400 @break
            @case(16) bg-teal-400 @break
            @default bg-zinc-600
        @endswitch
        text-teal-50 font-medium">
        <a href="{{ route('players.show', $player->id) }}"
           class="block truncate text-center sm:text-left"
           title="{{ $player->name }}">
            {{ $player->name }}
        </a>
    </td>                    @else
                        <td class="border border-zinc-500 px-2 py-1 min-w-0">
                            <a href="{{ route('players.show', $player->id) }}"
                               class="block truncate text-zinc-100 font-medium text-center sm:text-left"
                               title="{{ $player->name }}">
                                {{ $player->name }}
                            </a>
                        </td>
                    @endif

                    <!-- Рейтинг -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center font-bold text-amber-400">
                        {{ $player->games->sum('pivot.score') }}
                    </td>
                    <!-- Игры -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-slate-300">
                        {{ $player->total_games }}
                    </td>
                    <!-- Победы -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-green-400">
                        {{ $player->games->where('pivot.score', '>=', 2)->count() }}
                    </td>
                    <!-- Был лучшим -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-blue-400">
                        {{ $player->games->where('pivot.best_player', 1)->count() }}
                    </td>
                    <!-- Первым убитый -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-red-500">
                        {{ $player->games->where('pivot.first_victim', 1)->count() }}
                    </td>
                    <!-- Доп. баллы -->
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-purple-400">
                        {{ $player->games->sum('pivot.additional_score') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection