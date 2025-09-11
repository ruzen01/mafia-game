@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-2" x-data="{ tab: 'stats' }">
    <div class="text-center mb-6">
    <!-- Аватар игрока -->
    <div class="mb-4 flex justify-center">
        <div class="w-24 h-24 rounded-full bg-white border-4 border-zinc-200 shadow-md flex items-center justify-center overflow-hidden">
            <img 
                src="{{ $player->avatar_url }}" 
                alt="{{ $player->name }}" 
                class="w-full h-full object-cover"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
            >
            <div class="w-full h-full flex items-center justify-center text-zinc-300" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Заголовок -->
    <h1 class="text-2xl sm:text-3xl font-bold text-zinc-800">{{ $player->name }}</h1>

    <!-- Кнопки действий (только для админов) -->
    @canany(['update', 'delete'], $player)
    <div class="flex justify-center space-x-3 mt-4">
        @can('update', $player)
        <a href="{{ route('players.edit', $player->id) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2"
           title="Редактировать">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            <span>Редактировать</span>
        </a>
        @endcan

        @can('delete', $player)
        <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Удалить игрока {{ $player->name }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2"
                    title="Удалить">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
                <span>Удалить</span>
            </button>
        </form>
        @endcan
    </div>
    @endcanany
</div>

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
    <h2 class="text-xl font-bold mb-6 text-zinc-800 flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
        </svg>
        <span> Основная статистика</span>
    </h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-6 justify-items-center">
        <!-- Всего игр -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $player->games->count() }}</div>
            <div class="text-xs mt-1 text-center px-2">Всего игр</div>
        </div>

        <!-- Всего побед -->
        @php
            $totalWins = $player->games->where('pivot.score', '>=', 2)->count();
            $totalGames = $player->games->count();
            $winRate = $totalGames > 0 ? round(($totalWins / $totalGames) * 100, 1) : 0;
        @endphp
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $totalWins }}</div>
            <div class="text-xs mt-1 text-center px-2">Побед ({{ $winRate }}%)</div>
        </div>

        <!-- Лучший игрок -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $player->games->where('pivot.best_player', 1)->count() }}</div>
            <div class="text-xs mt-1 text-center px-2">Лучший игрок</div>
            <div class="text-lg">★</div>
        </div>

        <!-- Первая жертва -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $player->games->where('pivot.first_victim', 1)->count() }}</div>
            <div class="text-xs mt-1 text-center px-2">Первая жертва</div>
            <div class="text-lg">💀</div>
        </div>

        <!-- Доп. баллы -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $player->games->sum('pivot.additional_score') }}</div>
            <div class="text-xs mt-1 text-center px-2">Доп. баллы</div>
            <div class="text-lg">➕</div>
        </div>

        <!-- Баллы от ведущего -->
        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex flex-col items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
            <div class="text-3xl font-bold">{{ $player->games->sum('pivot.leader_score') }}</div>
            <div class="text-xs mt-1 text-center px-2">От ведущего</div>
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