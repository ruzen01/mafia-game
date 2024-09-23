@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать игру</h1>

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Поле Название игры -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Название игры:</label>
            <input type="text" name="name" id="name" value="{{ $game->name }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <!-- Поле Дата игры -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium">Дата игры:</label>
            <input type="date" name="date" id="date" value="{{ $game->date }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <!-- Поле Номер игры -->
        <div class="mb-4">
            <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
            <input type="text" name="game_number" id="game_number" value="{{ $game->game_number }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <!-- Поле Имя ведущего -->
        <div class="mb-4">
            <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
            <input type="text" name="host_name" id="host_name" value="{{ $game->host_name }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <!-- Поле Победитель -->
        <div class="mb-4">
            <label for="winner" class="block text-sm font-medium">Кто победил:</label>
            <input type="text" name="winner" id="winner" value="{{ $game->winner }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <!-- Игроки, их роли и баллы -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки, их роли и баллы:</h2>

            <div id="players-list">
                @foreach($game->players as $player)
                    <div class="player-row mb-2">
                        <select name="players[]" class="border rounded py-2 px-3">
                            @foreach($allPlayers as $availablePlayer)
                                <option value="{{ $availablePlayer->id }}" {{ $player->id == $availablePlayer->id ? 'selected' : '' }}>
                                    {{ $availablePlayer->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="roles[]" class="border rounded py-2 px-3 ml-2">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $player->pivot->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} ({{ $role->category }})
                                </option>
                            @endforeach
                        </select>

                        <!-- Лучший игрок -->
                        <label class="ml-2">Лучший игрок:</label>
                        <input type="checkbox" name="best_player[]" value="{{ $player->id }}" {{ $player->pivot->best_player ? 'checked' : '' }}>

                        <!-- Первая жертва -->
                        <label class="ml-2">Первая жертва:</label>
                        <input type="checkbox" name="first_victim[]" value="{{ $player->id }}" {{ $player->pivot->first_victim ? 'checked' : '' }}>

                        <!-- Баллы от ведущего -->
                        <input type="number" name="leader_scores[]" value="{{ $player->pivot->leader_score }}" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2" min="0">

                           <!-- Дополнительный балл -->
                            <label class="ml-2">Дополнительный балл:</label>
                            <input type="checkbox" name="additional_score[]" value="{{ $player->id }}" {{ $player->pivot->additional_score ? 'checked' : '' }}>

                        <!-- Комментарий -->
                        <input type="text" name="comments[]" value="{{ $player->pivot->comment }}" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2">

                        <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-1 px-2 mt-2 rounded">Добавить игрока</button>
        </div>

        <!-- Кнопка для сохранения изменений -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Сохранить изменения</button>
    </form>
</div>

<!-- Скрипт для добавления и удаления игроков -->
<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3">
                @foreach($allPlayers as $availablePlayer)
                    <option value="{{ $availablePlayer->id }}">{{ $availablePlayer->name }}</option>
                @endforeach
            </select>
            <select name="roles[]" class="border rounded py-2 px-3 ml-2">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                @endforeach
            </select>

            <label class="ml-2">Лучший игрок:</label>
            <input type="checkbox" name="best_player[]" value="1">
            <label class="ml-2">Первая жертва:</label>
            <input type="checkbox" name="first_victim[]" value="1">
            <input type="number" name="leader_scores[]" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2" min="0">

                <label class="ml-2">Дополнительный балл:</label>
                <input type="checkbox" name="additional_score[]" value="{{ $player->id }}" {{ $player->pivot->additional_score ? 'checked' : '' }}>
            <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2">
            <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
        `;
        playersList.appendChild(newRow);

        // Добавление функционала удаления нового игрока
        newRow.querySelector('.remove-player-row').addEventListener('click', function() {
            this.parentNode.remove();
        });
    });

    document.querySelectorAll('.remove-player-row').forEach(function(button) {
        button.addEventListener('click', function() {
            this.parentNode.remove();
        });
    });
</script>
@endsection