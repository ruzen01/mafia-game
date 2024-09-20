@extends('layouts.app')

@section('title', 'Рейтинг игроков')

@section('content')
<h1>Рейтинг игроков</h1>

<table>
    <thead>
        <tr>
            <th>Место</th>
            <th>Имя игрока</th>
            <th>Общий рейтинг</th>
            <th>Количество игр</th>
            <th>Средний балл за игру</th>
            <th>Детали</th>
        </tr>
    </thead>
    <tbody>
        @foreach($players as $index => $player)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->calculateRating() }}</td>
                <td>{{ $player->games->count() }}</td>
                <td>{{ number_format($player->calculateRating() / max($player->games->count(), 1), 2) }}</td>
                <td><a href="{{ route('players.show', $player->id) }}">Подробнее</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection