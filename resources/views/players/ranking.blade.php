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
                <tr class="odd:bg-gray-800 even:bg-gray-900 @if($loop->iteration == 1) first-place @elseif($loop->iteration == 2) second-place @elseif($loop->iteration == 3) third-place @endif hover-row">
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
    /* Анимация перелива текста слева направо для первого места (золотой) */
    .first-place {
        font-size: 1.25rem;
        font-weight: bold;
        background: linear-gradient(90deg, #FFD700, #FFB700, #FFD700);
        background-size: 200% 100%;
        -webkit-background-clip: text;
        color: transparent;
        animation: gold-wave 3s infinite alternate;
    }

    /* Анимация перелива текста слева направо для второго места (серебряный) */
    .second-place {
        font-size: 1.25rem;
        font-weight: bold;
        background: linear-gradient(90deg, #C0C0C0, #B0B0B0, #C0C0C0);
        background-size: 200% 100%;
        -webkit-background-clip: text;
        color: transparent;
        animation: silver-wave 3s infinite alternate;
    }

    /* Анимация перелива текста слева направо для третьего места (бронзовый) */
    .third-place {
        font-size: 1.25rem;
        font-weight: bold;
        background: linear-gradient(90deg, #CD7F32, #D2691E, #CD7F32);
        background-size: 200% 100%;
        -webkit-background-clip: text;
        color: transparent;
        animation: bronze-wave 3s infinite alternate;
    }

    /* Эффект увеличения при наведении для всех строк */
    .hover-row:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease-in-out;
    }

    /* Анимация для золотой волны */
    @keyframes gold-wave {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: 0 0;
        }
    }

    /* Анимация для серебряной волны */
    @keyframes silver-wave {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: 0 0;
        }
    }

    /* Анимация для бронзовой волны */
    @keyframes bronze-wave {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: 0 0;
        }
    }
</style>
@endsection