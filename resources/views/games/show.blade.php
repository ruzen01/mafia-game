@extends('layouts.app')

@section('title', 'Детали игры')

@section('content')
<h1>Детали игры №{{ $game->game_number }} от {{ $game->date->format('d.m.Y') }}</h1>

<p><strong>Ведущий:</strong> {{ $game->host->name }}</p>
<p><strong>Результат игры:</strong> {{ $game->result }}</p>

<h2>Участники</h2>
<table>
    <thead>
        <tr>
            <th>Имя игрока</th>
            <th>Роль</th>
            <th>Итого за игру</th>
            <th>Дополнительный</th>
            <th>За лучшего игрока</th>
            <th>За первую жертву убийства</th>
            <th>От ведущего</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($game->players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->pivot->role }}</td>
                <td>{{ $player->pivot->total_points }}</td>
                <td>{{ $player->pivot->additional_points }}</td>
                <td>{{ $player->pivot->best_player ? 'Да' : 'Нет' }}</td>
                <td>{{ $player->pivot->first_victim ? 'Да' : 'Нет' }}</td>
                <td>{{ $player->pivot->from_host_points }}</td>
                <td>{{ $player->pivot->comment }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('games.index') }}">← Вернуться к списку игр</a>
@endsection