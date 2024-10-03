@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Рейтинг игроков</h1>

    <!-- Пример с алфавитными группами и липкими заголовками -->
    <div class="overflow-y-scroll max-h-[500px] border border-gray-400">
        <!-- Группа игроков, чьи имена начинаются с A -->
        <div class="mb-6">
            <!-- Липкий заголовок для буквы A -->
            <div class="sticky top-0 bg-gray-500 p-4 font-bold z-10">A</div>
            <div class="space-y-4">
                @foreach($players->filter(fn($player) => Str::startsWith($player->name, 'A')) as $player)
                <div class="flex items-center">
                    <strong class="mr-4">{{ $loop->iteration }}.</strong> <!-- Порядковый номер -->
                    <strong>{{ $player->name }}</strong>
                    <div class="ml-auto flex items-center space-x-4">
                        <span>Σ Баллов: {{ $player->games->sum('pivot.score') }}</span>
                        <span>Σ Игр: {{ $player->total_games }}</span>
                        <span>Σ Побед: {{ $player->games->where('pivot.score', '>=', 2)->count() }}</span>
                        <span>Σ Лучших: {{ $player->games->where('pivot.best_player', 1)->count() }}</span>
                        <span>Σ Первых жертв: {{ $player->games->where('pivot.first_victim', 1)->count() }}</span>
                        <span>Σ Доп. баллов: {{ $player->games->sum('pivot.additional_score') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Группа игроков, чьи имена начинаются с B -->
        <div class="mb-6">
            <!-- Липкий заголовок для буквы B -->
            <div class="sticky top-0 bg-gray-500 p-4 font-bold z-10">B</div>
            <div class="space-y-4">
                @foreach($players->filter(fn($player) => Str::startsWith($player->name, 'B')) as $player)
                <div class="flex items-center">
                    <strong class="mr-4">{{ $loop->iteration }}.</strong> <!-- Порядковый номер -->
                    <strong>{{ $player->name }}</strong>
                    <div class="ml-auto flex items-center space-x-4">
                        <span>Σ Баллов: {{ $player->games->sum('pivot.score') }}</span>
                        <span>Σ Игр: {{ $player->total_games }}</span>
                        <span>Σ Побед: {{ $player->games->where('pivot.score', '>=', 2)->count() }}</span>
                        <span>Σ Лучших: {{ $player->games->where('pivot.best_player', 1)->count() }}</span>
                        <span>Σ Первых жертв: {{ $player->games->where('pivot.first_victim', 1)->count() }}</span>
                        <span>Σ Доп. баллов: {{ $player->games->sum('pivot.additional_score') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Можно добавить аналогичные группы для других букв (C, D, и т.д.) -->
        <!-- ... -->

    </div>
</div>
@endsection