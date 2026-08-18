@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <!-- Заголовок и счетчик игр -->
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-center sm:text-left text-zinc-800">
            Рейтинг игроков
        </h1>
        
        <!-- Плашка с общим количеством игр -->
        <div class="mt-3 sm:mt-0 bg-zinc-800 text-white px-5 py-2.5 rounded-xl shadow-md flex items-center space-x-3 transform hover:scale-105 transition-transform duration-200">
            <!-- Иконка джойстика (как в списке игр) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="text-amber-400" viewBox="0 0 16 16">
                <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
                <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
            </svg>
            <span class="font-semibold text-sm sm:text-base">
                Всего игр: <span class="text-amber-400 font-bold text-lg">{{ $totalGames }}</span>
            </span>
        </div>
    </div>

    <!-- Далее идет ваш существующий код таблицы (div с overflow-x-auto и т.д.) -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-200 text-xs sm:text-sm">
        <!-- ... остальной код без изменений ... -->
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