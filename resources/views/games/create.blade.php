@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">
        {{ isset($game) ? 'Редактировать игру' : 'Создать новую игру' }}
    </h1>

    <form action="{{ isset($game) ? route('games.update', $game->id) : route('games.store') }}" method="POST">
        @csrf
        @if(isset($game)) @method('PUT') @endif

        <!-- Дата, номер, сезон -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium">Дата игры:</label>
                <input 
                    type="date" 
                    name="date" 
                    id="date" 
                    value="{{ old('date', $game->date ?? '') }}" 
                    class="border rounded py-2 px-3 w-full h-10 text-gray-900" 
                    required>
            </div>
            <div class="flex-1">
                <label for="game_number" class="block text-sm font-medium">Номер игры:</label>
                <select name="game_number" id="game_number" class="border rounded py-2 px-3 w-full h-10 text-gray-900" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ (old('game_number', $game->game_number ?? '') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1">
                <label for="season" class="block text-sm font-medium">Сезон:</label>
                <select name="season" id="season" class="border rounded py-2 px-3 w-full h-10 text-gray-900" required>
                    @foreach ($seasons as $season)
                        <option value="{{ $season }}" {{ (old('season', $game->season ?? '') == $season) ? 'selected' : '' }}>{{ $season }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Название, ведущий, победитель -->
        <div class="flex flex-wrap gap-4 mb-4 w-full">
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium">Название игры:</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $game->name ?? '') }}" 
                    class="border rounded py-2 px-3 w-full h-10 text-gray-900" 
                    required>
            </div>
            <div class="flex-1">
                <label for="host_name" class="block text-sm font-medium">Ведущий:</label>
                <input 
                    type="text" 
                    name="host_name" 
                    id="host_name" 
                    value="{{ old('host_name', $game->host_name ?? '') }}" 
                    class="border rounded w-full py-2 px-3 h-10 text-gray-900" 
                    required>
            </div>
            <div class="flex-1">
                <label for="winner" class="block text-sm font-medium">Кто победил:</label>
                <select name="winner" id="winner" class="border rounded py-2 px-3 w-full h-10 text-gray-900" required>
                    <option value="Мафия" {{ (old('winner', $game->winner ?? '') == 'Мафия') ? 'selected' : '' }}>Мафия</option>
                    <option value="Мирные жители" {{ (old('winner', $game->winner ?? '') == 'Мирные жители') ? 'selected' : '' }}>Мирные жители</option>
                    <option value="Третья сторона" {{ (old('winner', $game->winner ?? '') == 'Третья сторона') ? 'selected' : '' }}>Третья сторона</option>
                </select>
            </div>
        </div>

        <hr class="border-t-2 border-gray-300 mb-4">

        <!-- Игроки -->
        <div class="mb-4">
            <h2 class="block text-sm font-medium">Игроки, их роли и баллы:</h2>
            <div id="players-list" class="flex flex-wrap gap-2">
                @if(isset($game))
                    @foreach($game->players as $index => $player)
                        <div class="player-row flex flex-wrap gap-2 mb-2 items-center">
                            <select name="players[{{ $index }}][id]" class="border rounded py-2 px-3 flex-1 h-10 text-gray-900 player-select" required>
                                <option value="">Выберите игрока</option>
                                @foreach($players ?? $allPlayers as $p)
                                    <option value="{{ $p->id }}" {{ $p->id == $player->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <select name="players[{{ $index }}][role_id]" class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $player->pivot->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }} ({{ $role->category }})
                                    </option>
                                @endforeach
                            </select>

                            <!-- Лучший игрок -->
                            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                                <label>Лучший:</label>
                                <input type="hidden" name="players[{{ $index }}][best_player]" value="0">
                                <input type="checkbox" name="players[{{ $index }}][best_player]" value="1" class="h-6 w-6" {{ $player->pivot->best_player ? 'checked' : '' }}>
                            </div>

                            <!-- Первая кровь -->
                            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                                <label>Первая кровь:</label>
                                <input type="hidden" name="players[{{ $index }}][first_victim]" value="0">
                                <input type="checkbox" name="players[{{ $index }}][first_victim]" value="1" class="h-6 w-6" {{ $player->pivot->first_victim ? 'checked' : '' }}>
                            </div>

                            <!-- Доп. баллы -->
                            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                                <label>Доп:</label>
                                <input type="hidden" name="players[{{ $index }}][additional_score]" value="0">
                                <input type="checkbox" name="players[{{ $index }}][additional_score]" value="1" class="h-6 w-6" {{ $player->pivot->additional_score ? 'checked' : '' }}>
                            </div>

                            <input 
                                type="number" 
                                name="players[{{ $index }}][leader_score]" 
                                value="{{ old("players.{$index}.leader_score", $player->pivot->leader_score ?? 0) }}" 
                                placeholder="Баллы" 
                                class="border rounded py-2 px-2 ml-2 w-24 h-10 text-gray-900">
                            <input 
                                type="text" 
                                name="players[{{ $index }}][comment]" 
                                value="{{ old("players.{$index}.comment", $player->pivot->comment ?? '') }}" 
                                placeholder="Комментарий" 
                                class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900">
                            <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
                        </div>
                    @endforeach
                @else
                    <div class="player-row flex flex-wrap gap-2 mb-2 items-center">
                        <select name="players[0][id]" class="border rounded py-2 px-3 flex-1 h-10 text-gray-900 player-select" required>
                            <option value="">Выберите игрока</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                        <select name="players[0][role_id]" class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->name === 'Мирный житель' ? 'selected' : '' }}>
                                    {{ $role->name }} ({{ $role->category }})
                                </option>
                            @endforeach
                        </select>

                        <!-- Лучший игрок -->
                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label>Лучший:</label>
                            <input type="hidden" name="players[0][best_player]" value="0">
                            <input type="checkbox" name="players[0][best_player]" value="1" class="h-6 w-6">
                        </div>

                        <!-- Первая кровь -->
                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label>Первая кровь:</label>
                            <input type="hidden" name="players[0][first_victim]" value="0">
                            <input type="checkbox" name="players[0][first_victim]" value="1" class="h-6 w-6">
                        </div>

                        <!-- Доп. баллы -->
                        <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                            <label>Доп:</label>
                            <input type="hidden" name="players[0][additional_score]" value="0">
                            <input type="checkbox" name="players[0][additional_score]" value="1" class="h-6 w-6">
                        </div>

                        <input type="number" name="players[0][leader_score]" value="0" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10 text-gray-900">
                        <input type="text" name="players[0][comment]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900">
                        <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-player-row" class="bg-green-500 text-white py-2 px-4 mt-2 rounded h-10 w-48">Добавить игрока</button>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded font-bold text-lg">
            {{ isset($game) ? 'Обновить игру' : 'Создать игру' }}
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let playerIndex = {{ isset($game) ? $game->players->count() : 1 }};

    document.getElementById('add-player-row').addEventListener('click', function () {
        const playersList = document.getElementById('players-list');
        const newRow = document.createElement('div');
        newRow.classList.add('player-row', 'flex', 'flex-wrap', 'gap-2', 'mb-2', 'items-center');
        newRow.innerHTML = `
            <select name="players[${playerIndex}][id]" class="border rounded py-2 px-3 flex-1 h-10 text-gray-900 player-select" required>
                <option value="">Выберите игрока</option>
                @foreach($players ?? $allPlayers as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
            <select name="players[${playerIndex}][role_id]" class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->name === 'Мирный житель' ? 'selected' : '' }}>
                        {{ $role->name }} ({{ $role->category }})
                    </option>
                @endforeach
            </select>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label>Лучший:</label>
                <input type="hidden" name="players[${playerIndex}][best_player]" value="0">
                <input type="checkbox" name="players[${playerIndex}][best_player]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label>Первая кровь:</label>
                <input type="hidden" name="players[${playerIndex}][first_victim]" value="0">
                <input type="checkbox" name="players[${playerIndex}][first_victim]" value="1" class="h-6 w-6">
            </div>
            <div class="flex items-center gap-2 border border-gray-600 bg-white rounded py-2 px-3 h-10">
                <label>Доп:</label>
                <input type="hidden" name="players[${playerIndex}][additional_score]" value="0">
                <input type="checkbox" name="players[${playerIndex}][additional_score]" value="1" class="h-6 w-6">
            </div>
            <input type="number" name="players[${playerIndex}][leader_score]" value="0" placeholder="Баллы" class="border rounded py-2 px-2 ml-2 w-24 h-10 text-gray-900">
            <input type="text" name="players[${playerIndex}][comment]" placeholder="Комментарий" class="border rounded py-2 px-3 ml-2 flex-1 h-10 text-gray-900">
            <button type="button" class="remove-player-row bg-red-500 text-white py-2 px-3 rounded ml-2 h-10">Удалить</button>
        `;
        playersList.appendChild(newRow);
        playerIndex++;

        newRow.querySelector('.remove-player-row').addEventListener('click', function () {
            this.closest('.player-row').remove();
            updatePlayerSelects();
        });

        updatePlayerSelects();
    });

    document.querySelectorAll('.remove-player-row').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.player-row').remove();
            updatePlayerSelects();
        });
    });

    function updatePlayerSelects() {
        const selects = document.querySelectorAll('.player-select');
        const usedIds = Array.from(selects).map(s => s.value).filter(v => v);
        selects.forEach(select => {
            Array.from(select.options).forEach(option => {
                if (usedIds.includes(option.value) && option.value !== select.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    document.addEventListener('change', e => {
        if (e.target.classList.contains('player-select')) {
            setTimeout(updatePlayerSelects, 100);
        }
    });

    updatePlayerSelects();
});
</script>
@endsection