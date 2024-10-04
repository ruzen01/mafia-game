@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Рейтинг игроков</h1>
    <div class="overflow-auto rounded-lg shadow-lg">
        <table class="table-fixed w-full">
            <thead class="bg-gray-700 text-white sticky top-0 z-10">
                <tr>
                    <th class="w-1/12 px-4 py-2 text-gray-500 text-center">#</th>
                    <th class="truncate w-2/6 px-4 py-2 text-yellow-500 text-center">Игрок</th>
                    <th class="truncate w-1/6 px-4 py-2 text-pink-500 text-center">Σ Баллов</th>
                    <th class="truncate w-1/6 px-4 py-2 text-blue-500 text-center">Σ Игр</th>
                    <th class="truncate w-1/6 px-4 py-2 text-green-500 text-center">Σ Побед</th>
                    <th class="truncate w-1/6 px-4 py-2 text-orange-500 text-center">Σ Лучших</th>
                    <th class="truncate w-1/6 px-4 py-2 text-purple-500 text-center">Σ Первых жертв</th>
                    <th class="truncate w-1/6 px-4 py-2 text-red-500 text-center">Σ Доп. баллов</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                <tr class="odd:bg-gray-800 even:bg-gray-900 @if($loop->iteration <= 3) highlight-player @endif">
                    <td class="w-1/12 px-4 py-1 text-center">{{ $loop->iteration }}</td>
                    <td class="truncate w-2/6 px-4 py-1 text-left">{{ $player->name }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->games->sum('pivot.score') }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->total_games }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <td class="w-1/6 px-4 py-1 text-center">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Плавная анимация изменения фона для первых трёх игроков */
    .highlight-player {
        background: linear-gradient(90deg, rgba(255,215,0,0.1), rgba(255,223,0,0.3));
        animation: glow 3s ease-in-out infinite alternate;
    }

    /* Добавление эффекта увеличения и тени при наведении */
    .highlight-player:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(255, 223, 0, 0.7);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Анимация плавного "свечения" */
    @keyframes glow {
        0% {
            background-color: rgba(255, 223, 0, 0.1);
        }
        100% {
            background-color: rgba(255, 223, 0, 0.3);
        }
    }
</style>
@endsection