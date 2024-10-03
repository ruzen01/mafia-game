@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Рейтинг игроков</h1>

    <table class="table-auto shadow-lg rounded-lg overflow-hidden border-collapse border border-gray-500 w-full">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="border border-gray-400 px-4 py-2 bg-yellow-500 text-left">Игрок</th>
                <th class="border border-gray-400 px-4 py-2 bg-pink-500 text-center">Σ Баллов</th>
                <th class="border border-gray-400 px-4 py-2 bg-blue-500 text-center">Σ Игр</th>
                <th class="border border-gray-400 px-4 py-2 bg-green-500 text-center">Σ Побед</th>
                <th class="border border-gray-400 px-4 py-2 bg-orange-500 text-center">Σ Лучших</th>
                <th class="border border-gray-400 px-4 py-2 bg-purple-500 text-center">Σ Первых жертв</th>
                <th class="border border-gray-400 px-4 py-2 bg-red-500 text-center">Σ Доп. баллов</th>
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
@endsection