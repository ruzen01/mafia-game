@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-3xl font-bold mb-6">Список игроков</h1>
    <div class="flex justify-center mb-4">
        <a href="{{ route('players.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Создать нового игрока</a>
    </div>
    <table class="table-auto border-collapse border border-gray-500 w-3/4 mx-auto">
        <thead class="text-left">
            <tr>
                <th class="border border-gray-400 px-4 py-2">Имя</th>
                <th class="border border-gray-400 px-4 py-2">Игры</th>
                <th class="border border-gray-400 px-4 py-2">Дата создания</th>
                <th class="border border-gray-400 px-4 py-2">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td class="border border-gray-400 px-4 py-2">{{ $player->name }}</td>
                <td class="border border-gray-400 px-4 py-2">
                    @if($player->games->isEmpty())
                    Нет игр
                    @else
                    <div class="game-list" id="game-list-{{ $player->id }}">
                        @php
                        $games = $player->games->pluck('name')->toArray();
                        $shownGames = array_slice($games, 0, 3); // Показываем только первые 3 игры
                        $remainingGames = array_slice($games, 3); // Остальные игры скрываем
                        @endphp

                        <!-- Показываем первые три игры -->
                        <span>{{ implode(', ', $shownGames) }}</span>

                        <!-- Если есть скрытые игры, отображаем "..." -->
                        @if(count($remainingGames) > 0)
                        <span class="more-dots" onclick="showFullList({{ $player->id }})" style="color: blue; cursor: pointer;">... ещё</span>
                        <span class="full-list" style="display: none;">{{ implode(', ', $remainingGames) }}</span>
                        @endif
                    </div>
                    @endif
                </td>
                <td class="border border-gray-400 px-4 py-2">{{ \Carbon\Carbon::parse($player->date)->format('d.m.Y') }}</td>
                <td class="border border-gray-400 px-4 py-2">
                    <!-- Синяя ссылка "Изменить" -->
                    <a href="{{ route('players.edit', $player) }}" style="color: yellow; margin-right: 20px;">Изменить</a>

                    <!-- Красная ссылка "Удалить" -->
                    <a href="#"
                        style="color: red; cursor: pointer; margin-right: 20px;"
                        onclick="event.preventDefault(); if(confirm('Вы уверены, что хотите удалить?')){document.getElementById('delete-player-{{ $player->id }}').submit();}">
                        Удалить
                    </a>

                    <!-- Форма для удаления, которая отправляется при клике на "Удалить" -->
                    <form id="delete-player-{{ $player->id }}" action="{{ route('players.destroy', $player) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript для раскрытия полного списка игр -->
<script>
    function showFullList(playerId) {
        const dots = document.querySelector(`#game-list-${playerId} .more-dots`);
        const fullList = document.querySelector(`#game-list-${playerId} .full-list`);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            fullList.style.display = "none";
        } else {
            dots.style.display = "none";
            fullList.style.display = "inline";
        }
    }
</script>

@endsection