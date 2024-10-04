@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">{{ $player->name }} - Профиль</h1>

    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Статистика игрока</h2>
        <ul class="list-disc list-inside">
            <li>Всего игр: {{ $player->games->count() }}</li>
            <li>Всего побед: {{ $player->games->where('pivot.score', '>=', 2)->count() }}</li>
            <li>Количество лучших игр: {{ $player->games->where('pivot.best_player', 1)->count() }}</li>
            <li>Количество первых жертв: {{ $player->games->where('pivot.first_victim', 1)->count() }}</li>
            <li>Дополнительные баллы: {{ $player->games->sum('pivot.additional_score') }}</li>
        </ul>
    </div>

    <div class="mt-6">
        <a href="{{ route('players.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Назад к списку игроков
        </a>
    </div>
</div>
@endsection