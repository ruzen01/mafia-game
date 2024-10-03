@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Рейтинг игроков</h1>

    <div class="overflow-x-auto">
        <table class="table-auto shadow-lg rounded-lg overflow-hidden border-collapse border border-gray-500 w-full">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-yellow-200 text-center">Игрок</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-pink-200 text-center">Σ Баллов</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-blue-200 text-center">Σ Игр</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-green-200 text-center">Σ Побед</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-orange-200 text-center">Σ Лучших</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-purple-200 text-center">Σ Первых жертв</th>
                    <th class="sticky top-0 border border-gray-400 px-4 py-2 bg-red-200 text-center">Σ Доп. баллов</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                <tr>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->name }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->games->sum('pivot.score') }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->total_games }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->games->where('pivot.score', '>=', 2)->count() }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->games->where('pivot.best_player', 1)->count() }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->games->where('pivot.first_victim', 1)->count() }}</td>
                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $player->games->sum('pivot.additional_score') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection