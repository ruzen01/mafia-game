@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Подробная информация об игре: {{ $game->name }}</h1>

    <p><strong>Дата игры:</strong> {{ $game->date }}</p>
    <p><strong>Номер игры:</strong> {{ $game->game_number }}</p>
    <p><strong>Ведущий:</strong> {{ $game->host_name }}</p>
    <p><strong>Победитель:</strong> {{ $game->winner }}</p>

    <!-- Проверка, есть ли игроки у игры -->
    <p><strong>Игроки:</strong>
        @if($game->players)
            {{ $game->players->pluck('name')->implode(', ') }}
        @else
            Нет игроков
        @endif
    </p>

    <p><strong>Игроки и их баллы:</strong></p>
    <ul>
        @if($game->players)
            @foreach($game->players as $player)
            <li>{{ $player->name }}: {{ $player->pivot->score }} баллов</li>
            @endforeach
        @else
            <li>Нет игроков</li>
        @endif
    </ul>

    <a href="{{ route('games.edit', $game) }}" class="bg-yellow-500 text-white py-2 px-4 rounded">Изменить</a>

    <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Удалить</button>
    </form>
</div>
@endsection