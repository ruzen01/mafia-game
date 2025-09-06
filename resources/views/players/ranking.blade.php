@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-200 text-sm">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 px-2 py-2 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-amber-700 font-bold">Р</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-slate-700">И</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-green-700">П</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-blue-700">БЛ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-red-700">ПУ</th>
                    <th class="border border-zinc-500 w-10 px-1 py-2 text-center text-purple-700">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @foreach($players as $player)
                <tr 
                    class="
                        bg-zinc-200
                        @if($loop->iteration <= 3) border border-zinc-400 @endif
                        animate-fade-in
                    "
                    style="animation-delay: {{ $loop->iteration * 0.1 }}s"
                >
                    <td class="border border-zinc-500 w-8 px-1 py-1 text-center">
                        @if($loop->iteration <= 3)
                            <span class="font-bold text-lg">
                                {{ $loop->iteration == 1 ? '🥇' : ($loop->iteration == 2 ? '🥈' : '🥉') }}
                            </span>
                        @else
                            <span class="text-zinc-700 text-sm">{{ $loop->iteration }}</span>
                        @endif
                    </td>

                    <td class="border border-zinc-500 px-2 py-1 min-w-0">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                block truncate text-center sm:text-left font-semibold
                                @if($loop->iteration == 1) text-pink-700 @endif
                                @if($loop->iteration == 2) text-violet-700 @endif
                                @if($loop->iteration == 3) text-blue-700 @endif
                                @if($loop->iteration > 3 && $loop->iteration <= 10) text-zinc-800 @endif
                                @if($loop->iteration > 10) text-zinc-700 font-medium @endif
                           "
                           title="{{ $player->name }}">
                            {{ $player->name }}
                        </a>
                    </td>

                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center font-bold text-amber-700">
                        {{ $player->games->sum('pivot.score') }}
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-slate-700">
                        {{ $player->total_games }}
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-green-700">
                        {{ $player->games->where('pivot.score', '>=', 2)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-blue-700">
                        {{ $player->games->where('pivot.best_player', 1)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-red-700">
                        {{ $player->games->where('pivot.first_victim', 1)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-10 px-1 py-1 text-center text-purple-700">
                        {{ $player->games->sum('pivot.additional_score') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
@endsection