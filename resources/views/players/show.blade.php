@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-2" x-data="{ tab: 'stats' }">
    <h1 class="text-center text-2xl sm:text-3xl font-bold mb-6 text-zinc-800">{{ $player->name }} </h1>

    <!-- Табы -->
    <div class="flex justify-center mb-6 space-x-1 sm:space-x-4">
        <button 
            @click="tab = 'stats'"
            :class="tab === 'stats' ? 'bg-blue-500 text-white' : 'bg-zinc-200 text-zinc-700'"
            class="px-4 py-2 rounded-lg font-semibold transition hover:bg-blue-600 focus:outline-none flex items-center space-x-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
              <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
            </svg>
            <span>Статистика</span>
        </button>
        <button 
            @click="tab = 'games'"
            :class="tab === 'games' ? 'bg-blue-500 text-white' : 'bg-zinc-200 text-zinc-700'"
            class="px-4 py-2 rounded-lg font-semibold transition hover:bg-blue-600 focus:outline-none flex items-center space-x-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
              <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z"/>
              <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
            <span>Игры</span>
        </button>
    </div>

    <!-- Вкладка: Статистика -->
    <div x-show="tab === 'stats'" class="space-y-6">
        <!-- Основная статистика -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg p-6 border border-blue-100 animate-slide-up">
            <h2 class="text-xl font-bold mb-4 text-zinc-800 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                </svg>
                <span> Основная статистика</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Всего игр -->
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="text-3xl font-bold text-slate-700">{{ $player->games->count() }}</div>
                    <div class="text-sm text-zinc-600 mt-1">Всего игр</div>
                </div>

                <!-- Всего побед -->
                @php
                    $totalWins = $player->games->where('pivot.score', '>=', 2)->count();
                    $totalGames = $player->games->count();
                    $winRate = $totalGames > 0 ? round(($totalWins / $totalGames) * 100, 1) : 0;
                @endphp
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-green-100">
                    <div class="text-3xl font-bold text-green-700">{{ $totalWins }}</div>
                    <div class="text-sm text-zinc-600 mt-1">Побед</div>
                    <div class="text-xs text-green-600 mt-1">{{ $winRate }}% побед</div>
                </div>

                <!-- Лучший игрок -->
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-100">
                    <div class="text-3xl font-bold text-blue-700">{{ $player->games->where('pivot.best_player', 1)->count() }}</div>
                    <div class="text-sm text-zinc-600 mt-1">Лучший игрок</div>
                    <div class="text-xs text-blue-600 mt-1">★</div>
                </div>

                <!-- Первая жертва -->
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-red-100">
                    <div class="text-3xl font-bold text-red-700">{{ $player->games->where('pivot.first_victim', 1)->count() }}</div>
                    <div class="text-sm text-zinc-600 mt-1">Первая жертва</div>
                    <div class="text-xs text-red-600 mt-1">💀</div>
                </div>

                <!-- Доп. баллы -->
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-purple-100">
                    <div class="text-3xl font-bold text-purple-700">{{ $player->games->sum('pivot.additional_score') }}</div>
                    <div class="text-sm text-zinc-600 mt-1">Доп. баллы</div>
                    <div class="text-xs text-purple-600 mt-1">➕</div>
                </div>

                <!-- Баллы от ведущего -->
                <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-amber-100">
                    <div class="text-3xl font-bold text-amber-700">{{ $player->games->sum('pivot.leader_score') }}</div>
                    <div class="text-sm text-zinc-600 mt-1">От ведущего</div>
                </div>
            </div>
        </div>

        <!-- Коэффициенты побед по фракциям -->
        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl shadow-lg p-6 border border-orange-100 animate-slide-up" style="animation-delay: 0.2s">
            <h2 class="text-xl font-bold mb-4 text-zinc-800 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
                  <path d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z"/>
                </svg>
                <span> Коэффициенты побед</span>
            </h2>
            <div class="space-y-4">

                @php
                    $categories = [
                        'Мирные жители' => ['color' => 'text-red-700', 'bg' => 'bg-red-500', 'border' => 'border-red-100'],
                        'Мафия' => ['color' => 'text-zinc-800', 'bg' => 'bg-zinc-800', 'border' => 'border-zinc-200'],
                        'Третья сторона' => ['color' => 'text-orange-600', 'bg' => 'bg-orange-500', 'border' => 'border-orange-100'],
                    ];

                    $categoryStats = [];
                    foreach ($categories as $category => $style) {
                        $gamesInCategory = $player->games->filter(function ($game) use ($category, $roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === $category;
                        });
                        $winsInCategory = $gamesInCategory->where('pivot.score', '>=', 2)->count();
                        $totalInCategory = $gamesInCategory->count();
                        $rate = $totalInCategory > 0 ? round(($winsInCategory / $totalInCategory) * 100, 1) : 0;

                        $categoryStats[$category] = [
                            'games' => $totalInCategory,
                            'wins' => $winsInCategory,
                            'rate' => $rate,
                            'color' => $style['color'],
                            'bg' => $style['bg'],
                            'border' => $style['border'],
                        ];
                    }
                @endphp

                @foreach($categoryStats as $category => $stat)
                    <div class="bg-white rounded-xl p-4 shadow-md border {{ $stat['border'] }} hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold {{ $stat['color'] }}">{{ $category }}</span>
                            <span class="text-2xl font-bold {{ $stat['color'] }}">{{ $stat['rate'] }}%</span>
                        </div>
                        <div class="text-sm text-zinc-600 mb-1">
                            Побед: {{ $stat['wins'] }} из {{ $stat['games'] }} игр
                        </div>
                        <div class="w-full bg-zinc-200 rounded-full h-2.5">
                            <div class="{{ $stat['bg'] }} h-2.5 rounded-full" style="width: {{ min($stat['rate'], 100) }}%"></div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Вкладка: Игры -->
    <div x-show="tab === 'games'" class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-lg p-6 border border-green-100 animate-slide-up" style="animation-delay: 0.3s">
        <h2 class="text-xl font-bold mb-4 text-zinc-800 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
              <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z"/>
              <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
            <span> Последние игры ({{ $player->games->count() }})</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-zinc-300 w-full text-xs sm:text-sm">
                <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="border border-zinc-300 px-3 py-2 text-left">Дата</th>
                        <th class="border border-zinc-300 px-3 py-2 text-left">Роль</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-amber-300">Р</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-blue-300">БЛ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-red-300">ПУ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-purple-300">ДБ</th>
                    </tr>
                </thead>
                <tbody class="bg-zinc-100 divide-y divide-zinc-300">
                    @foreach($player->games->sortByDesc('date') as $game)
                        @php
                            $roleId = $game->pivot->role_id;
                            $role = $roles[$roleId] ?? null;
                        @endphp
                        <tr class="hover:bg-zinc-200 transition">
                            <td class="border border-zinc-300 px-3 py-2 font-medium text-zinc-800 whitespace-nowrap">
                                <a href="{{ route('games.show', $game->id) }}" class="hover:underline hover:text-blue-600">
                                    {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                                </a>
                            </td>
                            <td class="border border-zinc-300 px-3 py-2 text-zinc-600">
                                {{ $role->name ?? '—' }}
                                <span class="block text-xs 
                                    @if($role && $role->category === 'Мирные жители') text-red-600
                                    @elseif($role && $role->category === 'Мафия') text-zinc-800
                                    @elseif($role && $role->category === 'Третья сторона') text-orange-600
                                    @else text-zinc-500 @endif">
                                    {{ $role->category ?? '' }}
                                </span>
                            </td>
                            <td class="border border-zinc-300 px-3 py-2 text-center font-bold text-amber-700">
                                {{ $game->pivot->score }}
                            </td>
                            <td class="border border-zinc-300 px-3 py-2 text-center text-blue-700">
                                {{ $game->pivot->best_player ? '★' : '' }}
                            </td>
                            <td class="border border-zinc-300 px-3 py-2 text-center text-red-700">
                                {{ $game->pivot->first_victim ? '💀' : '' }}
                            </td>
                            <td class="border border-zinc-300 px-3 py-2 text-center text-purple-700">
                                {{ $game->pivot->additional_score ? '➕' : '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Кнопка назад -->
    <div class="mt-8 text-center animate-fade-in" style="animation-delay: 0.5s">
        <a href="{{ route('players.index') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold transition transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            <span>Назад к списку игроков</span>
        </a>
    </div>
</div>

<style>
    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-slide-up {
        animation: slide-up 0.6s ease-out forwards;
        opacity: 0;
    }

    @keyframes fade-in {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection