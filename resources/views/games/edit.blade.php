@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Редактировать игру</h1>

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Дата игры, Номер игры и Сезон на одной строке -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" value="{{ $game->date }}" class="border rounded py-2 px-3 w-full h-10 bg-gray-100 text-gray-900" required>
            </div>
            <div class="flex-1">
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-full h-10 bg-gray-100 text-gray-900" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $game->game_number == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full h-10 bg-gray-100 text-gray-900" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}" {{ $game->season == $season ? 'selected' : '' }}>{{ $season }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Название игры, Ведущий и Кто победил на одной строке -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" value="{{ $game->name }}" class="border rounded py-2 px-3 w-full h-10 bg-gray-100 text-gray-900" required>
            </div>
            <div class="flex-1">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input type="text" name="host_name" id="host_name" value="{{ $game->host_name }}" class="border rounded w-full py-2 px-3 h-10 bg-gray-100 text-gray-900" required>
            </div>
            <div class="flex-1">
                <label for="winner" class="block text-sm font-medium">Кто победил:</label>
                <select name="winner" id="winner" class="border rounded py-2 px-3 w-full h-10 bg-gray-100 text-gray-900" required>
                    <option value="Мафия" {{ $game->winner == 'Мафия' ? 'selected' : '' }}>Мафия</option>
                    <option value="Мирные жители" {{ $game->winner == 'Мирные жители' ? 'selected' : '' }}>Мирные жители</option>
                    <option value="Третья сторона" {{ $game->winner == 'Третья сторона' ? 'selected' : '' }}>Третья сторона</option>
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
                    <div class="player-row flex flex-wrap gap-2 mb-2" data-player-id="{{ $player->id }}">
                        <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10 bg-gray-100 text-gray-900">
                            @foreach($allPlayers as $availablePlayer)
                                <option value="{{ $availablePlayer->id }}" {{ $player->id == $availablePlayer->id ? 'selected' : '' }}>
                                    {{ $availablePlayer->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1 h-10 bg-gray-100 text-gray-900">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $player->pivot->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} ({{ $role->category }})
                                </option>
                            @endforeach
                        </select>

                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label class="ml-2">Лучший:</label>
                            <input type="checkbox" name="best_player[]" value="{{ $player->id }}" {{ $player->pivot->best_player ? 'checked' : '' }} class="h-6 w-6">
                        </div>
                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label class="ml-2">Первая кровь:</label>
                            <input type="checkbox" name="first_victim[]" value="{{ $player->id }}" {{ $player->pivot->first_victim ? 'checked' : '' }} class="h-6 w-6">
                        </div>
                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label class="ml-2">Доп:</label>
                            <input type="checkbox" name="additional_score[]" value="{{ $player->id }}" {{ $player->pivot->additional_score ? 'checked' : '' }} class="h-6 w-6">
                        </div>

                        <input type="number" name="leader_scores[]" value="{{ $player->pivot->leader_score }}" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10 bg-gray-100 text-gray-900">
                        <input type="text" name="comments[]" value="{{ $player->pivot->comment }}" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10 bg-gray-100 text-gray-900">

                        <!-- Кнопка для удаления игрока -->
                        <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10" data-player-id="{{ $player->id }}">Удалить</button>
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
        newRow.classList.add('player-row', 'mb-1', 'flex', 'items-center', 'gap-2', 'w-full');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10 bg-gray-100 text-gray-900">
                @foreach($allPlayers as $availablePlayer)
                    <option value="{{ $availablePlayer->id }}">{{ $availablePlayer->name }}</option>
                @endforeach
            </select>
            <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1 h-10 bg-gray-100 text-gray-900">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                @endforeach
            </select>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label class="ml-2">Лучший:</label>
                <input type="checkbox" name="best_player[]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label class="ml-2">Первая кровь:</label>
                <input type="checkbox" name="first_victim[]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label class="ml-2">Доп:</label>
                <input type="checkbox" name="additional_score[]" value="1" class="h-6 w-6">
            </div>
            <input type="number" name="leader_scores[]" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10 bg-gray-100 text-gray-900">
            <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10 bg-gray-100 text-gray-900">
            <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
        `;
        playersList.appendChild(newRow);
        newRow.querySelector('.remove-player-row').addEventListener('click', function() {
            this.parentNode.remove();
        });
    });

    document.querySelectorAll('.remove-player-row').forEach(button => {
        button.addEventListener('click', function() {
            const playerId = this.getAttribute('data-player-id');

            // Если игрок уже существует в базе данных, добавляем его в список для удаления
            if (playerId) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'players_to_delete[]';
                input.value = playerId;
                document.querySelector('form').appendChild(input);
            }

            // Удаляем строку игрока из DOM
            this.closest('.player-row').remove();
        });
    });
</script>
@endsection