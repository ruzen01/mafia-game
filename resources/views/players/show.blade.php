<!-- Основная статистика -->
<div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg p-6 border border-blue-100 animate-slide-up">
    <h2 class="text-xl font-bold mb-6 text-zinc-800 flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
        </svg>
        <span> Основная статистика</span>
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <!-- Левая часть: Круговая диаграмма + Заголовок -->
        <div class="flex flex-col items-center space-y-4">
            @php
                $totalGames = $player->games->count();
                $gamesAsPeace = $player->games->filter(function ($game) use ($roles) {
                    $roleId = $game->pivot->role_id;
                    return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мирные жители';
                })->count();
                $gamesAsMafia = $player->games->filter(function ($game) use ($roles) {
                    $roleId = $game->pivot->role_id;
                    return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мафия';
                })->count();
                $gamesAsOther = $totalGames - $gamesAsPeace - $gamesAsMafia;

                $percentPeace = $totalGames > 0 ? ($gamesAsPeace / $totalGames) * 100 : 0;
                $percentMafia = $totalGames > 0 ? ($gamesAsMafia / $totalGames) * 100 : 0;
                $percentOther = $totalGames > 0 ? ($gamesAsOther / $totalGames) * 100 : 0;

                // Рассчитываем длину дуг для SVG
                $circumference = 2 * 3.1416 * 45; // радиус 45px
                $offsetPeace = $circumference * (1 - $percentPeace / 100);
                $offsetMafia = $circumference * (1 - ($percentPeace + $percentMafia) / 100);
            @endphp

            <!-- Круговой индикатор -->
            <div class="relative w-40 h-40 flex items-center justify-center">
                <svg class="transform -rotate-90 w-40 h-40" viewBox="0 0 100 100">
                    <!-- Фоновый серый круг -->
                    <circle
                        cx="50"
                        cy="50"
                        r="45"
                        stroke="#e5e7eb"
                        stroke-width="10"
                        fill="transparent"
                    ></circle>
                    <!-- Сегмент "Мирные жители" (красный) -->
                    @if($percentPeace > 0)
                    <circle
                        cx="50"
                        cy="50"
                        r="45"
                        stroke="#ef4444" <!-- red-500 -->
                        stroke-width="10"
                        fill="transparent"
                        stroke-dasharray="{{ $circumference }}"
                        stroke-dashoffset="{{ $offsetPeace }}"
                        class="transition-all duration-1000 ease-out"
                    ></circle>
                    @endif
                    <!-- Сегмент "Мафия" (черный) -->
                    @if($percentMafia > 0)
                    <circle
                        cx="50"
                        cy="50"
                        r="45"
                        stroke="#1f2937" <!-- zinc-800 -->
                        stroke-width="10"
                        fill="transparent"
                        stroke-dasharray="{{ $circumference }}"
                        stroke-dashoffset="{{ $offsetMafia }}"
                        class="transition-all duration-1000 ease-out"
                    ></circle>
                    @endif
                    <!-- Сегмент "Третья сторона" (оранжевый) -->
                    @if($percentOther > 0)
                    <circle
                        cx="50"
                        cy="50"
                        r="45"
                        stroke="#f97316" <!-- orange-500 -->
                        stroke-width="10"
                        fill="transparent"
                        stroke-dasharray="{{ $circumference }}"
                        stroke-dashoffset="0"
                        class="transition-all duration-1000 ease-out"
                    ></circle>
                    @endif
                </svg>
                <!-- Центральный текст -->
                <div class="absolute text-center">
                    <div class="text-3xl font-bold text-zinc-800">{{ $totalGames }}</div>
                    <div class="text-xs text-zinc-600 mt-1">Всего игр</div>
                </div>
            </div>

            <!-- Легенда под кругом -->
            <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 text-xs">
                <div class="flex items-center space-x-1">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span>Мирные</span>
                </div>
                <div class="flex items-center space-x-1">
                    <div class="w-3 h-3 rounded-full bg-zinc-800"></div>
                    <span>Мафия</span>
                </div>
                <div class="flex items-center space-x-1">
                    <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                    <span>Другие</span>
                </div>
            </div>
        </div>

        <!-- Правая часть: Таблица -->
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md border border-zinc-200 overflow-hidden">
                <div class="divide-y divide-zinc-200">
                    <!-- Заголовок таблицы -->
                    <div class="grid grid-cols-3 bg-zinc-100 px-4 py-3 font-semibold text-zinc-700 text-sm">
                        <div>Сторона</div>
                        <div class="text-center">Игры</div>
                        <div class="text-center">Винрейт</div>
                    </div>

                    <!-- Мирные жители -->
                    @php
                        $winsAsPeace = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мирные жители' && $game->pivot->score >= 2;
                        })->count();
                        $winRatePeace = $gamesAsPeace > 0 ? round(($winsAsPeace / $gamesAsPeace) * 100, 1) : 0;
                    @endphp
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-50 transition">
                        <div class="font-medium text-red-600">Мирные</div>
                        <div class="text-center font-medium">{{ $gamesAsPeace }}</div>
                        <div class="text-center text-green-600 font-medium">{{ $winRatePeace }}%</div>
                    </div>

                    <!-- Мафия -->
                    @php
                        $winsAsMafia = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Мафия' && $game->pivot->score >= 2;
                        })->count();
                        $winRateMafia = $gamesAsMafia > 0 ? round(($winsAsMafia / $gamesAsMafia) * 100, 1) : 0;
                    @endphp
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-50 transition">
                        <div class="font-medium text-zinc-800">Мафия</div>
                        <div class="text-center font-medium">{{ $gamesAsMafia }}</div>
                        <div class="text-center text-green-600 font-medium">{{ $winRateMafia }}%</div>
                    </div>

                    <!-- Третья сторона -->
                    @php
                        $winsAsOther = $player->games->filter(function ($game) use ($roles) {
                            $roleId = $game->pivot->role_id;
                            return isset($roles[$roleId]) && $roles[$roleId]->category === 'Третья сторона' && $game->pivot->score >= 2;
                        })->count();
                        $winRateOther = $gamesAsOther > 0 ? round(($winsAsOther / $gamesAsOther) * 100, 1) : 0;
                    @endphp
                    <div class="grid grid-cols-3 px-4 py-3 text-sm hover:bg-zinc-50 transition">
                        <div class="font-medium text-orange-600">Другие</div>
                        <div class="text-center font-medium">{{ $gamesAsOther }}</div>
                        <div class="text-center text-green-600 font-medium">{{ $winRateOther }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Дополнительные показатели (перенесены ниже) -->
    <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
        <!-- Лучший игрок -->
        <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-100 text-center">
            <div class="text-2xl font-bold text-blue-700">{{ $player->games->where('pivot.best_player', 1)->count() }}</div>
            <div class="text-sm text-zinc-600 mt-1">Лучший игрок</div>
            <div class="text-lg text-blue-600 mt-1">★</div>
        </div>

        <!-- Первая жертва -->
        <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-red-100 text-center">
            <div class="text-2xl font-bold text-red-700">{{ $player->games->where('pivot.first_victim', 1)->count() }}</div>
            <div class="text-sm text-zinc-600 mt-1">Первая жертва</div>
            <div class="text-lg text-red-600 mt-1">💀</div>
        </div>

        <!-- Доп. баллы -->
        <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-purple-100 text-center">
            <div class="text-2xl font-bold text-purple-700">{{ $player->games->sum('pivot.additional_score') }}</div>
            <div class="text-sm text-zinc-600 mt-1">Доп. баллы</div>
            <div class="text-lg text-purple-600 mt-1">➕</div>
        </div>

        <!-- Баллы от ведущего -->
        <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-amber-100 text-center col-span-2 sm:col-span-1">
            <div class="text-2xl font-bold text-amber-700">{{ $player->games->sum('pivot.leader_score') }}</div>
            <div class="text-sm text-zinc-600 mt-1">От ведущего</div>
        </div>
    </div>
</div>