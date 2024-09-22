@extends('layouts.app')

@section('title', 'Добавить новую игру')

@section('content')
<h1 class="text-2xl text-center mb-6">Добавить новую игру</h1>

<form action="{{ route('games.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="game_name" class="block text-gray-200 font-bold mb-2">Название игры:</label>
        <input type="text" name="game_name" id="game_name" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="date" class="block text-gray-200 font-bold mb-2">Дата игры:</label>
        <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="game_number" class="block text-gray-200 font-bold mb-2">Порядковый номер игры:</label>
        <input type="number" name="game_number" id="game_number" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="host_id" class="block text-gray-200 font-bold mb-2">Имя ведущего:</label>
        <select name="host_id" id="host_id" class="w-full px-4 py-2 border rounded text-gray-800" required>
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="result" class="block text-gray-200 font-bold mb-2">Результат игры:</label>
        <select name="result" id="result" class="w-full px-4 py-2 border rounded text-gray-800" required>
            <option value="Мафия">Мафия</option>
            <option value="Мирные жители">Мирные жители</option>
            <option value="Третья сторона">Третья сторона</option>
        </select>
    </div>

    <h2 class="text-xl font-bold mb-4 text-white">Участники</h2>
    <table class="w-full mb-4 border">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="p-2">Участник</th>
                <th class="p-2">Роль</th>
                <th class="p-2">Итого за игру</th>
                <th class="p-2">Дополнительный</th>
                <th class="p-2 text-center">За лучшего игрока</th>
                <th class="p-2 text-center">За первую жертву убийства</th>
                <th class="p-2">От ведущего</th>
                <th class="p-2">Комментарий</th>
                <th class="p-2">Действие</th>
            </tr>
        </thead>
        <tbody id="players-table">
            <!-- Динамически добавляемые строки участников -->
        </tbody>
    </table>
    <button type="button" onclick="addPlayerRow()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Добавить участника</button>

    <br><br>
    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Сохранить результаты</button>
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
                <select name="players[][player_id]" class="w-full px-2 py-1 border rounded text-black">
                    ${generatePlayerOptions()}
                </select>
                <input type="text" name="players[][custom_name]" class="w-full px-2 py-1 border rounded mt-2 text-black" placeholder="Имя вручную (если нет в списке)">
            </td>
            <td>
                <select name="players[][role]" class="w-full px-2 py-1 border rounded text-black" required>
                    <option value="Мафия">Мафия</option>
                    <option value="Мирный житель">Мирный житель</option>
                    <option value="Доктор">Доктор</option>
                </select>
            </td>
            <td><input type="number" name="players[][total_points]" class="w-full px-2 py-1 border rounded !text-black" value="0" required></td>
            <td><input type="number" name="players[][additional_points]" class="w-full px-2 py-1 border rounded !text-black" value="0" required></td>
            <td class="text-center"><input type="checkbox" name="players[][best_player]" value="1" class="mx-auto"></td>
            <td class="text-center"><input type="checkbox" name="players[][first_victim]" value="1" class="mx-auto"></td>
            <td><input type="number" name="players[][from_host_points]" class="w-full px-2 py-1 border rounded !text-black" value="0" required></td>
            <td><input type="text" name="players[][comment]" class="w-full px-2 py-1 border rounded !text-black"></td>
            <td><button type="button" onclick="removePlayerRow(this)" class="bg-red-500 text-white px-2 py-1 rounded">Удалить</button></td>
        `;
        table.appendChild(row);
    }

    function removePlayerRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
@endsection