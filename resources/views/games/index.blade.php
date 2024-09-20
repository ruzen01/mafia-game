@extends('layouts.app')

@section('title', 'Список игр')

@section('content')
<h1>Список игр</h1>

<a href="{{ route('games.create') }}">Добавить новую игру</a>

<table>
    <thead>
        <tr>
            <th>Дата</th>
            <th>Игра №</th>
            <th>Ведущий</th>
            <th>Результат</th>
            <th>Детали</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
            <tr>
                <td>{{ $game->date->format('d.m.Y') }}</td>
                <td>{{ $game->game_number }}</td>
                <td>{{ $game->host->name }}</td>
                <td>{{ $game->result }}</td>
                <td><a href="{{ route('games.show', $game->id) }}">Подробнее</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection