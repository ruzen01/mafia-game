@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Создать новую игру</h1>

    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <!-- Дата игры, Номер игры и Сезон на одной строке -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <!-- Поле Дата игры (1/3) -->
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" class="border rounded py-2 px-3 w-full h-10" required>
            </div>

            <!-- Поле Номер игры (1/3) -->
            <div class="flex-1">
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-full h-10" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Поле Сезон (1/3) -->
            <div class="flex-1">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full h-10" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}">{{ $season }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Название игры, Ведущий и Кто победил на одной строке -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <!-- Поле Название игры (1/3) -->
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" class="border rounded py-2 px-3 w-full h-10" required>
            </div>

            <!-- Поле Ведущий (1/3) -->
            <div class="flex-1">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input type="text" name="host_name" id="host_name" class="border rounded w-full py-2 px-3 h-10" required>
            </div>

            <!-- Поле Кто победил (1/3) -->
            <div class="flex-1">
                <label for="winner" class="block text-sm font-medium">Кто победил:</label>
                <select name="winner" id="winner" class="border rounded py-2 px-3 w-full h-10" required>
                    <option value="Мафия">Мафия</option>
                    <option value="Мирные жители">Мирные жители</option>
                    <option value="Третья сторона">Третья сторона</option>
                </select>
            </div>
        </div>

        <!-- Поле для добавления игроков, их ролей и баллов -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки, их роли и баллы:</h2>
            <div id="players-list" class="flex flex-wrap gap-2">
                <div class="player-row mb-1 flex items-center gap-2 w-full">
                    <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                    <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1 h-10">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->category }})</option>
                        @endforeach
                    </select>

                    <!-- Лучший игрок, Первая кровь и Доп в одинаковых рамках -->
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

                    <!-- Баллы от ведущего (уменьшенное поле) -->
                    <input type="number" name="leader_scores[]" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10">

                    <!-- Комментарий -->
                    <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10">

                    <!-- Кнопка Удалить с красным фоном и белым текстом -->
                    <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
                </div>
            </div>
            <!-- Кнопка Добавить игрока -->
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-2 px-4 mt-2 rounded h-10 w-48">Добавить игрока</button>
        </div>

        <!-- Кнопка создания игры -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded h-10 w-48">Создать игру</button>
    </form>
</div>

<!-- Скрипт для добавления и удаления игроков -->
<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-1', 'flex', 'items-center', 'gap-2', 'w-full');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3 flex-1 h-10">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
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