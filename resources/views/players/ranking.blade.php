@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Рейтинг игроков</h1>

    <table class="table-auto shadow-lg rounded-lg overflow-hidden border-collapse border border-gray-500 w-full">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="border border-gray-400 px-4 py-2">Игрок</th>
                <th class="border border-gray-400 px-4 py-2">Баллы</th>
                <th class="border border-gray-400 px-4 py-2">Количество игр</th>
                <th class="border border-gray-400 px-4 py-2">Количество побед</th>
                <th class="border border-gray-400 px-4 py-2">Количество поражений</th>
                <th class="border border-gray-400 px-4 py-2">Баллы за лучшего</th>
                <th class="border border-gray-400 px-4 py-2">Баллы за первую жертву</th>
                <th class="border border-gray-400 px-4 py-2">Дополнительные баллы</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td class="border border-gray-400 px-4 py-2">{{ $player->name }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->total_points }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->total_games }}</td>

                <!-- Общее количество побед -->
                <td class="border border-gray-400 px-4 py-2">{{ $player->total_wins }}</td>

                <!-- Общее количество поражений -->
                <td class="border border-gray-400 px-4 py-2">{{ $player->total_losses }}</td>

                <!-- Дополнительные баллы -->
                <td class="border border-gray-400 px-4 py-2">{{ $player->best_player_points }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->first_victim_points }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->additional_points }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection