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
    /* Золотой перелив для первого места */
    .first-place {
        font-size: 1.25rem;
        font-weight: bold;
        animation: gold-shift 3s infinite alternate;
    }

    /* Серебряный перелив для второго места */
    .second-place {
        font-size: 1.25rem;
        font-weight: bold;
        animation: silver-shift 3s infinite alternate;
    }

    /* Бронзовый перелив для третьего места */
    .third-place {
        font-size: 1.25rem;
        font-weight: bold;
        animation: bronze-shift 3s infinite alternate;
    }

    /* Подсветка строки при наведении */
    .hover-row:hover {
        background-color: #444444; /* Цвет подсветки строки */
        transition: background-color 0.3s ease-in-out;
    }

    /* Анимация для золотого текста */
    @keyframes gold-shift {
        0% {
            color: #FFD700; /* Золотой */
        }
        100% {
            color: #FFB700; /* Яркий золотой */
        }
    }

    /* Анимация для серебряного текста */
    @keyframes silver-shift {
        0% {
            color: #C0C0C0; /* Серебряный */
        }
        100% {
            color: #B0B0B0; /* Яркий серебряный */
        }
    }

    /* Анимация для бронзового текста */
    @keyframes bronze-shift {
        0% {
            color: #CD7F32; /* Бронзовый */
        }
        100% {
            color: #D2691E; /* Яркий бронзовый */
        }
    }
</style>
@endsection