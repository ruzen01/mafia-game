@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Редактировать игру</h1>

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" value="{{ $game->name }}" class="border rounded py-2 px-3 w-full h-10" required>
            </div>
            <div class="flex-1">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full h-10" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}" {{ $game->season == $season ? 'selected' : '' }}>{{ $season }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" value="{{ $game->date }}" class="border rounded py-2 px-3 w-full h-10" required>
            </div>
            <div class="flex-1">
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-full h-10" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $game->game_number == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Разделительная линия -->
        <hr class="border-t-2 border-gray-300 mb-4">

        <!-- Игроки, их роли и баллы -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки, их роли и баллы:</h2>
            <div id="players-list">
                @foreach($game->players as $player)
                    <div class="player-row flex flex-wrap gap-2 mb-1">
                        <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10">
                            @foreach($allPlayers as $availablePlayer)
                                <option value="{{ $availablePlayer->id }}" {{ $player->id == $availablePlayer->id ? 'selected' : '' }}>{{ $availablePlayer->name }}</option>
                            @endforeach
                        </select>
                        <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1 h-10">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $player->pivot->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} ({{ $role->category }})
                                </option>
                            @endforeach
                        </select>

                        <div class="flex items-center gap-2 border rounded py-2 px-3">
                            <label class="ml-2">Лучший:</label>
                            <input type="checkbox" name="best_player[]" value="{{ $player->id }}" {{ $player->pivot->best_player ? 'checked' : '' }}>
                        </div>
                        <div class="flex items-center gap-2 border rounded py-2 px-3">
                            <label class="ml-2">Первая кровь:</label>
                            <input type="checkbox" name="first_victim[]" value="{{ $player->id }}" {{ $player->pivot->first_victim ? 'checked' : '' }}>
                        </div>
                        <div class="flex items-center gap-2 border rounded py-2 px-3">
                            <label class="ml-2">Доп:</label>
                            <input type="checkbox" name="additional_score[]" value="{{ $player->id }}" {{ $player->pivot->additional_score ? 'checked' : '' }}>
                        </div>

                        <input type="number" name="leader_scores[]" value="{{ $player->pivot->leader_score }}" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10">
                        <input type="text" name="comments[]" value="{{ $player->pivot->comment }}" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10">
                        <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-2 px-4 mt-2 rounded h-10 w-48">Добавить игрока</button>
        </div>

        <!-- Кнопка для сохранения изменений -->
        <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded font-bold text-lg">Сохранить изменения</button>
    </form>
</div>

<!-- Скрипт для добавления и удаления игроков -->
<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2', 'flex', 'items-center', 'gap-2', 'w-full');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10">
                @foreach($allPlayers as $availablePlayer)
                    <option value="{{ $availablePlayer->id }}">{{ $availablePlayer->name }}</option>
                @endforeach
            </select>
            <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1 h-10">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                @endforeach
            </select>
            <div class="flex items-center gap-2 border rounded py-2 px-3">
                <label class="ml-2">Лучший:</label>
                <input type="checkbox" name="best_player[]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border rounded py-2 px-3">
                <label class="ml-2">Первая кровь:</label>
                <input type="checkbox" name="first_victim[]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border rounded py-2 px-3">
                <label class="ml-2">Доп:</label>
                <input type="checkbox" name="additional_score[]" value="1" class="h-6 w-6">
            </div>
            <input type="number" name="leader_scores[]" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10">
            <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10">
            <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
        `;
        playersList.appendChild(newRow);
        newRow.querySelector('.remove-player-row').addEventListener('click', function() {
            this.parentNode.remove();
        });
    });
</script>
@endsection