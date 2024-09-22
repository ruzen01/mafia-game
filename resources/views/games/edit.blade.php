@extends('layouts.app')

@section('content')
<form action="{{ route('games.update', $game) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium">Название игры:</label>
        <input type="text" name="name" value="{{ $game->name }}" class="border rounded w-full py-2 px-3">
    </div>

    <div class="mb-4">
        <label for="date" class="block text-sm font-medium">Дата игры:</label>
        <input type="date" name="date" value="{{ $game->date }}" class="border rounded w-full py-2 px-3">
    </div>

    <div class="mb-4">
        <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
        <input type="text" name="game_number" value="{{ $game->game_number }}" class="border rounded w-full py-2 px-3">
    </div>

    <div class="mb-4">
        <label for="host_name" class="block text-sm font-medium">Имя ведущего:</label>
        <input type="text" name="host_name" value="{{ $game->host_name }}" class="border rounded w-full py-2 px-3">
    </div>

    <div class="mb-4">
        <label for="players" class="block text-sm font-medium">Игроки и баллы:</label>
        <div>
            @foreach($players as $player)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="players[]" value="{{ $player->id }}"
                        @if($game->players && $game->players->contains($player->id)) checked @endif>
                    <span class="ml-2">{{ $player->name }}</span>
                    <input type="number" name="scores[]" value="{{ $game->players && $game->players->find($player->id)?->pivot->score ?? 0 }}"
                           class="border rounded ml-2 py-1 px-2" placeholder="Баллы">
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Сохранить изменения</button>
</form>
@endsection