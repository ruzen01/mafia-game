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

        <!-- Существующие игроки и их баллы -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки и их баллы:</h2>

            <div id="players-list">
                @foreach($game->players as $player)
                    <div class="player-row mb-2">
                        <!-- Список существующих игроков -->
                        <select name="players[]" class="border rounded py-2 px-3" required>
                            @foreach($allPlayers as $availablePlayer)
                                <option value="{{ $availablePlayer->id }}" {{ $player->id == $availablePlayer->id ? 'selected' : '' }}>
                                    {{ $availablePlayer->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Поле для изменения баллов игрока -->
                        <input type="number" name="scores[]" value="{{ $player->pivot->score }}" class="border rounded py-2 px-3 ml-2" min="0" required>
                        <!-- Кнопка для удаления игрока -->
                        <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
                    </div>
                @endforeach
            </div>

            <!-- Кнопка добавления нового игрока -->
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-1 px-2 mt-2 rounded">Добавить игрока</button>
        </div>

        <!-- Кнопка для сохранения изменений -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Сохранить изменения</button>
    </form>
</div>

<!-- Скрипт для добавления и удаления игроков -->
<script>
    // Добавление нового игрока
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3" required>
                @foreach($allPlayers as $availablePlayer)
                    <option value="{{ $availablePlayer->id }}">{{ $availablePlayer->name }}</option>
                @endforeach
            </select>
            <input type="number" name="scores[]" placeholder="Баллы" class="border rounded py-2 px-3 ml-2" min="0" required>
            <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
        `;
        playersList.appendChild(newRow);

        // Добавление функционала удаления нового игрока
        newRow.querySelector('.remove-player-row').addEventListener('click', function() {
            this.parentNode.remove();
        });
    });

    // Удаление существующих игроков
    document.querySelectorAll('.remove-player-row').forEach(function(button) {
        button.addEventListener('click', function() {
            this.parentNode.remove();
        });
    });
</script>
@endsection