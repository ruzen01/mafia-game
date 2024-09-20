@extends('layouts.app')

@section('title', 'Добавить новую игру')

@section('content')
<h1>Добавить новую игру</h1>

<form action="{{ route('games.store') }}" method="POST">
    @csrf
    <div>
        <label for="date">Дата игры:</label>
        <input type="date" name="date" id="date" required>
    </div>
    <div>
        <label for="game_number">Порядковый номер игры:</label>
        <input type="number" name="game_number" id="game_number" required>
    </div>
    <div>
        <label for="host_id">Имя ведущего:</label>
        <select name="host_id" id="host_id" required>
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="result">Результат игры:</label>
        <select name="result" id="result" required>
            <option value="Мафия">Мафия</option>
            <option value="Мирные жители">Мирные жители</option>
            <option value="Третья сторона">Третья сторона</option>
        </select>
    </div>

    <h2>Участники</h2>
    <table>
        <thead>
            <tr>
                <th>Участник</th>
                <th>Роль</th>
                <th>Итого за игру</th>
                <th>Дополнительный</th>
                <th>За лучшего игрока</th>
                <th>За первую жертву убийства</th>
                <th>От ведущего</th>
                <th>Комментарий</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody id="players-table">
            <!-- Динамически добавляемые строки участников -->
        </tbody>
    </table>
    <button type="button" onclick="addPlayerRow()">Добавить участника</button>

    <br><br>
    <button type="submit">Сохранить результаты</button>
</form>

<script>
    let players = @json($players);

    function generatePlayerOptions() {
        let options = '';
        players.forEach(function(player) {
            options += `<option value="${player.id}">${player.name}</option>`;
        });
        return options;
    }

    function addPlayerRow() {
        const table = document.getElementById('players-table');
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>
                <select name="players[][player_id]" required>
                    ${generatePlayerOptions()}
                </select>
            </td>
            <td>
                <select name="players[][role]" required>
                    <option value="Мафия">Мафия</option>
                    <option value="Мирный житель">Мирный житель</option>
                    <option value="Доктор">Доктор</option>
                    <!-- Добавьте другие роли по необходимости -->
                </select>
            </td>
            <td><input type="number" name="players[][total_points]" value="0" required></td>
            <td><input type="number" name="players[][additional_points]" value="0" required></td>
            <td><input type="checkbox" name="players[][best_player]" value="1"></td>
            <td><input type="checkbox" name="players[][first_victim]" value="1"></td>
            <td><input type="number" name="players[][from_host_points]" value="0" required></td>
            <td><input type="text" name="players[][comment]"></td>
            <td><button type="button" onclick="removePlayerRow(this)">Удалить</button></td>
        `;
        table.appendChild(row);
    }

    function removePlayerRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
@endsection