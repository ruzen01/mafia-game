@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать игру</h1>

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Название игры, дата игры, номер игры и сезон на одной строке -->
        <div class="flex mb-4">
            <!-- Поле Название игры -->
            <div class="flex-1 mr-4">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" value="{{ $game->name }}" class="border rounded w-full py-2 px-3" required>
            </div>

            <!-- Поле Сезон -->
            <div class="ml-4">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full" required>
                    <option value="Осень-зима 2024-2025" {{ $game->season == 'Осень-зима 2024-2025' ? 'selected' : '' }}>Осень-зима 2024-2025</option>
                    <!-- В будущем можно добавить больше сезонов -->
                </select>
            </div>

            <!-- Поле Дата игры -->
            <div class="mr-4">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" value="{{ $game->date }}" class="border rounded py-2 px-3 w-40" required>
            </div>

            <!-- Поле Номер игры (выпадающий список) -->
            <div>
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-20" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $game->game_number == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Ведущий и кто победил на одной строке -->
        <div class="flex mb-4">
            <!-- Поле Имя ведущего -->
            <div class="flex-1 mr-4">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input type="text" name="host_name" id="host_name" value="{{ $game->host_name }}" class="border rounded w-full py-2 px-3" required>
            </div>

            <!-- Поле Кто победил (выпадающий список) -->
            <div class="flex-1">
                <label for="winner" class="block text-sm font-medium">Кто победил:</label>
                <select name="winner" id="winner" class="border rounded py-2 px-3 w-full" required>
                    <option value="Мафия" {{ $game->winner == 'Мафия' ? 'selected' : '' }}>Мафия</option>
                    <option value="Мирные жители" {{ $game->winner == 'Мирные жители' ? 'selected' : '' }}>Мирные жители</option>
                    <option value="Третья сторона" {{ $game->winner == 'Третья сторона' ? 'selected' : '' }}>Третья сторона</option>
                </select>
            </div>
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

                        <!-- Дополнительный балл -->
                        <label class="ml-2">Дополнительный балл:</label>
                        <input type="checkbox" name="additional_score[]" value="{{ $player->id }}" {{ $player->pivot->additional_score ? 'checked' : '' }}>

                        <!-- Баллы от ведущего -->
                        <input type="number" name="leader_scores[]" value="{{ $player->pivot->leader_score }}" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2" min="0">

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
            <label class="ml-2">Дополнительный балл:</label>
            <input type="checkbox" name="additional_score[]" value="1">
            <input type="number" name="leader_scores[]" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2" min="0">
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