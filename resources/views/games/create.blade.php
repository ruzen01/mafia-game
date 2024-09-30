@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создать новую игру</h1>

    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <!-- Название игры, дата игры и номер игры на одной строке -->
        <div class="flex mb-4">
            <!-- Поле Название игры -->
            <div class="flex-1 mr-4">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            <div class="form-group">
    <label for="season">Сезон</label>
    <select name="season" id="season" class="form-control">
        @foreach ($seasons as $season)
            <option value="{{ $season }}">{{ $season }}</option>
        @endforeach
    </select>
</div>

            <!-- Поле Дата игры -->
            <div class="mr-4">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" class="border rounded py-2 px-3 w-40 text-gray-700" required>
            </div>

            <!-- Поле Номер игры (выпадающий список) -->
            <div>
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-20 text-gray-700" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Ведущий и кто победил на одной строке -->
        <div class="flex mb-4">
            <!-- Поле Имя ведущего -->
            <div class="flex-1 mr-4">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input type="text" name="host_name" id="host_name" class="border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            <!-- Поле Кто победил (выпадающий список) -->
            <div class="flex-1">
                <label for="winner" class="block text-sm font-medium">Кто победил:</label>
                <select name="winner" id="winner" class="border rounded py-2 px-3 w-full text-gray-700" required>
                    <option value="Мафия">Мафия</option>
                    <option value="Мирные жители">Мирные жители</option>
                    <option value="Третья сторона">Третья сторона</option>
                </select>
            </div>
        </div>

        <!-- Поле для добавления игроков, ролей и баллов -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки, их роли и баллы:</h2>

            <div id="players-list">
                <div class="player-row mb-2">
                    <select name="players[]" class="border rounded py-2 px-3 text-gray-700">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                    <select name="roles[]" class="border rounded py-2 px-3 ml-2 text-gray-700">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                        @endforeach
                    </select>

                    <!-- Лучший игрок -->
                    <label class="ml-2">Лучший:</label>
                    <input type="checkbox" name="best_player[]" value="1">

                    <!-- Первая жертва -->
                    <label class="ml-2">Первая кровь:</label>
                    <input type="checkbox" name="first_victim[]" value="1">

                    <!-- Дополнительный балл -->
                    <label class="ml-2">Доп:</label>
                    <input type="checkbox" name="additional_score[]" value="1">

                    <!-- Баллы от ведущего -->
                    <input type="number" name="leader_scores[]" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2 text-gray-700" min="0">

                    <!-- Комментарий -->
                    <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 text-gray-700">

                    <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
                </div>
            </div>
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-1 px-2 mt-2 rounded">Добавить игрока</button>
        </div>

        <!-- Кнопка создания игры -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Создать игру</button>
    </form>
</div>

<!-- Скрипт для добавления и удаления игроков -->
<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3 text-gray-700">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
            <select name="roles[]" class="border rounded py-2 px-3 ml-2 text-gray-700">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                @endforeach
            </select>

            <label class="ml-2">Лучший:</label>
            <input type="checkbox" name="best_player[]" value="1">
            <label class="ml-2">Первая кровь:</label>
            <input type="checkbox" name="first_victim[]" value="1">
            <label class="ml-2">Доп:</label>
            <input type="checkbox" name="additional_score[]" value="1">
            <input type="number" name="leader_scores[]" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2 text-gray-700" min="0">
            <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 text-gray-700">
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