@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создать новую игру</h1>

    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Название игры:</label>
            <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium">Дата игры:</label>
            <input type="date" name="date" id="date" class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
            <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
            <input type="text" name="game_number" id="game_number" class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
            <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
            <input type="text" name="host_name" id="host_name" class="border rounded w-full py-2 px-3">
        </div>

        <!-- Поле для добавления игроков и их баллов -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки и их баллы:</h2>

            <div id="players-list">
                <div class="player-row mb-2">
                    <select name="players[]" class="border rounded py-2 px-3">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="scores[]" placeholder="Баллы" class="border rounded py-2 px-3 ml-2">
                    <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
                </div>
            </div>
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-1 px-2 mt-2 rounded">Добавить игрока</button>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Создать игру</button>
    </form>
</div>

<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
            <input type="number" name="scores[]" placeholder="Баллы" class="border rounded py-2 px-3 ml-2">
            <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
        `;
        playersList.appendChild(newRow);

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