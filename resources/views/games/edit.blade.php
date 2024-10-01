@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Редактировать игру</h1>

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Название игры, Сезон, Дата игры и Номер игры на одной строке с полной шириной -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <!-- Поле Название игры (6/16) -->
            <div class="flex-[6_6_0%]">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input type="text" name="name" id="name" value="{{ $game->name }}" class="border rounded w-full py-2 px-3" required>
            </div>

            <!-- Поле Сезон (4/16) -->
            <div class="flex-[4_4_0%]">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}" {{ $game->season == $season ? 'selected' : '' }}>{{ $season }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Поле Дата игры (4/16) -->
            <div class="flex-[4_4_0%]">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input type="date" name="date" id="date" value="{{ $game->date }}" class="border rounded py-2 px-3 w-full" required>
            </div>

            <!-- Поле Номер игры (2/16) -->
            <div class="flex-[2_2_0%]">
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-full" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $game->game_number == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Ведущий и Кто победил на одной строке с полной шириной -->
        <div class="flex gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input type="text" name="host_name" id="host_name" value="{{ $game->host_name }}" class="border rounded w-full py-2 px-3" required>
            </div>

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
                    <div class="player-row flex flex-wrap gap-4 mb-2">
                        <select name="players[]" class="border rounded py-2 px-3 flex-2">
                            @foreach($allPlayers as $availablePlayer)
                                <option value="{{ $availablePlayer->id }}" {{ $player->id == $availablePlayer->id ? 'selected' : '' }}>
                                    {{ $availablePlayer->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-2">
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
                        <input type="number" name="leader_scores[]" value="{{ $player->pivot->leader_score }}" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2 flex-1" min="0">
                        <!-- Комментарий -->
                        <input type="text" name="comments[]" value="{{ $player->pivot->comment }}" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-2">
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

<script>
    document.getElementById('add-player-row').addEventListener('click', function() {
        var playersList = document.getElementById('players-list');
        var newRow = document.createElement('div');
        newRow.classList.add('player-row', 'mb-2', 'flex', 'items-center', 'gap-2');
        newRow.innerHTML = `
            <select name="players[]" class="border rounded py-2 px-3 flex-1">
                @foreach($allPlayers as $availablePlayer)
                    <option value="{{ $availablePlayer->id }}">{{ $availablePlayer->name }}</option>
                @endforeach
            </select>
            <select name="roles[]" class="border rounded py-2 px-3 ml-2 flex-1">
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
            <input type="number" name="leader_scores[]" placeholder="Баллы от ведущего" class="border rounded py-2 px-3 ml-2 flex-1">
            <input type="text" name="comments[]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-2">
            <button type="button" class="remove-player-row text-red-500 ml-2">Удалить</button>
        `;
        playersList.appendChild(newRow);
        newRow.querySelector('.remove-player-row').addEventListener('click', function() {
            this.parentNode.remove();
        });
    });
</script>
@endsection