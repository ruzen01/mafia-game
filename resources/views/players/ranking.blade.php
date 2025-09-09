@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Рейтинг игроков</h1>

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-200 text-xs sm:text-sm">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 px-1 sm:px-2 py-2 text-left">Игрок</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-amber-300 font-bold">Р</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-slate-300">И</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-green-300">П</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-blue-300">БЛ</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-red-300">ПУ</th>
                    <th class="border border-zinc-500 w-6 sm:w-10 px-1 py-2 text-center text-purple-300">ДБ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @php
                    $maxScore = $players->max(fn($p) => $p->games->sum('pivot.score'));
                @endphp

                @foreach($players as $player)
                    @php
                        $score = $player->games->sum('pivot.score');
                        $progress = $maxScore > 0 ? ($score / $maxScore) * 100 : 0;
                    @endphp
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
        <div class="flex justify-center">
            @if($loop->iteration == 1)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-yellow-500" viewBox="0 0 16 16">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                </svg>
            @elseif($loop->iteration == 2)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-gray-400" viewBox="0 0 16 16">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                </svg>
            @elseif($loop->iteration == 3)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-amber-700" viewBox="0 0 16 16">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                </svg>
            @endif
        </div>
    @else
        <span class="text-zinc-700 text-xs sm:text-sm">{{ $loop->iteration }}</span>
    @endif
</td>

                    <td class="border border-zinc-500 px-1 sm:px-2 py-1 min-w-0 w-full">
                        <a 
                            href="{{ route('players.show', $player->id) }}"
                            class="
                                block w-full text-left font-semibold truncate
                                @if($loop->iteration == 1) text-pink-700 @endif
                                @if($loop->iteration == 2) text-violet-700 @endif
                                @if($loop->iteration == 3) text-blue-700 @endif
                                @if($loop->iteration > 3 && $loop->iteration <= 10) text-zinc-800 @endif
                                @if($loop->iteration > 10) text-zinc-700 font-medium @endif
                                hover:underline hover:text-blue-600 transition
                            "
                            title="Посмотреть профиль"
                        >
                            {{ $player->name }}
                        </a>
                        <div class="mt-1 w-full bg-zinc-300 rounded-full h-1.5">
                            <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    </td>

                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center font-bold text-amber-700">
                        {{ $score }}
                    </td>
                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center text-slate-700">
                        {{ $player->total_games }}
                    </td>
                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center text-green-700">
                        {{ $player->games->where('pivot.score', '>=', 2)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center text-blue-700">
                        {{ $player->games->where('pivot.best_player', 1)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center text-red-700">
                        {{ $player->games->where('pivot.first_victim', 1)->count() }}
                    </td>
                    <td class="border border-zinc-500 w-6 sm:w-10 px-1 py-1 text-center text-purple-700">
                        {{ $player->games->sum('pivot.additional_score') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
</div>
@endsection