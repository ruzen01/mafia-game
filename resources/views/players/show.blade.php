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
        :class="tab === 'stats' ? 'bg-zinc-700 text-white shadow-inner' : 'bg-zinc-200 text-zinc-800 hover:bg-zinc-300'"
        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 flex items-center space-x-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
          <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
        </svg>
        <span>Статистика</span>
    </button>
    <button 
        @click="tab = 'games'"
        :class="tab === 'games' ? 'bg-zinc-700 text-white shadow-inner' : 'bg-zinc-200 text-zinc-800 hover:bg-zinc-300'"
        class="px-4 py-2 rounded-lg font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 flex items-center space-x-2"
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
        <div class="bg-zinc-500 rounded-xl shadow-lg p-6 border border-zinc-600 animate-slide-up">
            <h2 class="text-xl font-bold mb-6 text-white flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                </svg>
                <span> Основная статистика</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Левая часть: Два больших блока -->
                <div class="flex flex-col space-y-4">
                    <!-- Всего игр -->
                    <div class="bg-zinc-800 rounded-xl p-6 text-center shadow-md border border-zinc-700">
                        <div class="text-4xl font-extrabold text-white">{{ $player->games->count() }}</div>
                        <div class="text-sm text-zinc-300 mt-2">Всего игр</div>
                    </div>

                    <!-- Общий винрейт -->
                    @php
                        $totalWins = $player->games->where('pivot.score', '>=', 2)->count();
                        $totalGames = $player->games->count();
                        $winRate = $totalGames > 0 ? round(($totalWins / $totalGames) * 100, 1) : 0;
                    @endphp
                    <div class="bg-zinc-800 rounded-xl p-6 text-center shadow-md border border-zinc-700">
                        <div class="text-4xl font-extrabold text-green-400">{{ $winRate }}<span class="text-xl">%</span></div>
                        <div class="text-sm text-zinc-300 mt-2">Общий винрейт</div>
                    </div>
                </div>

                <!-- Правая часть: Таблица по сторонам -->
                <div class="bg-zinc-800 rounded-lg shadow-md border border-zinc-700 overflow-hidden">
                    <div class="grid grid-cols-3 bg-zinc-900 px-4 py-3 font-semibold text-white text-sm">
                        <div>Сторона</div>
                        <div class="text-center">Игры</div>
                        <div class="text-center">Винрейт</div>
                    </div>

                    @php
                        $gamesAsPeace = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мирные жители';
                        })->count();
                        $winsAsPeace = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мирные жители' && $game->pivot->score >= 2;
                        })->count();
                        $winRatePeace = $gamesAsPeace > 0 ? round(($winsAsPeace / $gamesAsPeace) * 100, 1) : 0;

                        $gamesAsMafia = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мафия';
                        })->count();
                        $winsAsMafia = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мафия' && $game->pivot->score >= 2;
                        })->count();
                        $winRateMafia = $gamesAsMafia > 0 ? round(($winsAsMafia / $gamesAsMafia) * 100, 1) : 0;

                        $gamesAsOther = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Третья сторона';
                        })->count();
                        $winsAsOther = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Третья сторона' && $game->pivot->score >= 2;
                        })->count();
                        $winRateOther = $gamesAsOther > 0 ? round(($winsAsOther / $gamesAsOther) * 100, 1) : 0;
                    @endphp

                    <div class="divide-y divide-zinc-700">
                        <!-- Мирные жители -->
                        <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition">
                            <div class="font-medium text-red-400">Мирные</div>
                            <div class="text-center font-medium text-white">{{ $gamesAsPeace }}</div>
                            <div class="text-center text-green-400 font-medium">{{ $winRatePeace }}%</div>
                        </div>

                        <!-- Мафия -->
                        <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition">
                            <div class="font-medium text-zinc-300">Мафия</div>
                            <div class="text-center font-medium text-white">{{ $gamesAsMafia }}</div>
                            <div class="text-center text-green-400 font-medium">{{ $winRateMafia }}%</div>
                        </div>

                        <!-- Третья сторона -->
                        <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition">
                            <div class="font-medium text-orange-400">Другие</div>
                            <div class="text-center font-medium text-white">{{ $gamesAsOther }}</div>
                            <div class="text-center text-green-400 font-medium">{{ $winRateOther }}%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Нижняя таблица: Дополнительные показатели -->
            <div class="mt-8 bg-zinc-800 rounded-lg shadow-md border border-zinc-700 overflow-hidden">
                <div class="grid grid-cols-3 bg-zinc-900 px-4 py-3 font-semibold text-white text-sm">
                    <div>Показатель</div>
                    <div class="text-center">Значение</div>
                    <div class="text-center">Описание</div>
                </div>

                <div class="divide-y divide-zinc-700">
                    <!-- Лучший игрок -->
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition items-center">
                        <div class="font-medium text-blue-400">Лучший игрок</div>
                        <div class="text-center font-bold text-white flex items-center justify-center space-x-2">
                            <span class="text-blue-400 text-lg">★</span>
                            <span>{{ $player->games->where('pivot.best_player', 1)->count() }}</span>
                        </div>
                        <div class="text-xs text-zinc-400 text-center">Выбран ведущим</div>
                    </div>

                    <!-- Первая жертва -->
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition items-center">
                        <div class="font-medium text-red-400">Первая жертва</div>
                        <div class="text-center font-bold text-white flex items-center justify-center space-x-2">
                            <span class="text-red-400 text-lg">💀</span>
                            <span>{{ $player->games->where('pivot.first_victim', 1)->count() }}</span>
                        </div>
                        <div class="text-xs text-zinc-400 text-center">Первым выбыл</div>
                    </div>

                    <!-- Доп. баллы -->
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition items-center">
                        <div class="font-medium text-purple-400">Доп. баллы</div>
                        <div class="text-center font-bold text-white flex items-center justify-center space-x-2">
                            <span class="text-purple-400 text-lg">➕</span>
                            <span>{{ $player->games->sum('pivot.additional_score') }}</span>
                        </div>
                        <div class="text-xs text-zinc-400 text-center">За активность</div>
                    </div>

                    <!-- Баллы от ведущего -->
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-700 transition items-center">
                        <div class="font-medium text-amber-400">От ведущего</div>
                        <div class="text-center font-bold text-white flex items-center justify-center space-x-2">
                            <span class="text-amber-400 text-lg">👑</span>
                            <span>{{ $player->games->sum('pivot.leader_score') }}</span>
                        </div>
                        <div class="text-xs text-zinc-400 text-center">Субъективная оценка</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Вкладка: Игры -->
    <div x-show="tab === 'games'" class="bg-zinc-500 rounded-xl shadow-lg p-6 border border-zinc-600 animate-slide-up" style="animation-delay: 0.3s">
        <h2 class="text-xl font-bold mb-4 text-white flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
              <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z"/>
              <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
            <span> Последние игры ({{ $player->games->count() }})</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm border-collapse border border-zinc-600 rounded-lg overflow-hidden">
                <thead class="bg-zinc-900 text-white uppercase text-xs font-semibold">
                    <tr>
                        <th class="border border-zinc-600 px-3 py-2 text-left">Дата</th>
                        <th class="border border-zinc-600 px-3 py-2 text-left">Роль</th>
                        <th class="border border-zinc-600 px-3 py-2 text-center">Р</th>
                        <th class="border border-zinc-600 px-3 py-2 text-center">БЛ</th>
                        <th class="border border-zinc-600 px-3 py-2 text-center">ПУ</th>
                        <th class="border border-zinc-600 px-3 py-2 text-center">ДБ</th>
                    </tr>
                </thead>
                <tbody class="bg-zinc-800 divide-y divide-zinc-700 text-zinc-200">
                    @foreach($player->games->sortByDesc('date') as $game)
                        @php
                            $roleId = $game->pivot->role_id;
                            $role = $roles[$roleId] ?? null;
                        @endphp
                        <tr class="hover:bg-zinc-700 transition">
                            <td class="border border-zinc-600 px-3 py-2 font-medium whitespace-nowrap">
                                <a href="{{ route('games.show', $game->id) }}" class="hover:underline hover:text-blue-400">
                                    {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                                </a>
                            </td>
                            <td class="border border-zinc-600 px-3 py-2">
                                {{ $role->name ?? '—' }}
                                <span class="block text-xs 
                                    @if($role && $role->category === 'Мирные жители') text-red-400
                                    @elseif($role && $role->category === 'Мафия') text-zinc-300
                                    @elseif($role && $role->category === 'Третья сторона') text-orange-400
                                    @else text-zinc-400 @endif">
                                    {{ $role->category ?? '' }}
                                </span>
                            </td>
                            <td class="border border-zinc-600 px-3 py-2 text-center font-bold text-amber-400">
                                {{ $game->pivot->score }}
                            </td>
                            <td class="border border-zinc-600 px-3 py-2 text-center text-blue-400">
                                {{ $game->pivot->best_player ? '★' : '' }}
                            </td>
                            <td class="border border-zinc-600 px-3 py-2 text-center text-red-400">
                                {{ $game->pivot->first_victim ? '💀' : '' }}
                            </td>
                            <td class="border border-zinc-600 px-3 py-2 text-center text-purple-400">
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
   class="bg-zinc-200 hover:bg-zinc-300 active:bg-zinc-400 text-zinc-800 py-3 px-6 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-md hover:shadow-lg active:shadow-inner inline-flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2">
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