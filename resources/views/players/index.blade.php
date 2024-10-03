@extends('layouts.app')

@section('content')
@if(session('error'))
    <div id="error-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 text-white p-3 rounded mb-4 opacity-0 transition-opacity duration-500">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div id="success-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 text-white p-3 rounded mb-4 opacity-0 transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif

<script>
    // Плавное появление сообщения
    window.addEventListener('load', function () {
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');

        if (errorMessage) {
            errorMessage.classList.add('opacity-100');
            setTimeout(() => {
                errorMessage.classList.remove('opacity-100');
            }, 3000); // Сообщение исчезает через 3 секунды
        }

        if (successMessage) {
            successMessage.classList.add('opacity-100');
            setTimeout(() => {
                successMessage.classList.remove('opacity-100');
            }, 3000); // Сообщение исчезает через 3 секунды
        }
    });
</script>

    <h1 class="text-center text-3xl font-bold mb-6">Список игроков</h1>

    @can('create', App\Models\Player::class)
    <div class="flex justify-center mb-6">
        <a href="{{ route('players.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Создать нового игрока
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed w-full">
            <thead class="bg-gray-700 text-white sticky top-0 z-10">
                <tr>
                    <th class="w-1/4 px-4 py-2 text-center">Имя</th>
                    <th class="w-1/3 px-4 py-2 text-center">Игры</th>
                    <th class="w-1/4 px-4 py-2 text-center">Дата создания</th>
                    @can('update', App\Models\Player::class)
                    <th class="w-1/6 px-4 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="bg-gray-800 text-white">
                @foreach($players as $player)
                <tr class="odd:bg-gray-800 even:bg-gray-900">
                    <td class="w-1/4 px-4 py-1 truncate">{{ $player->name }}</td>
                    <td class="w-1/3 px-4 py-1">
                        @if($player->games->isEmpty())
                            Нет игр
                        @else
                            <div class="game-list" id="game-list-{{ $player->id }}">
                                @php
                                    $games = $player->games->pluck('name')->toArray();
                                    $shownGames = array_slice($games, 0, 3);
                                    $remainingGames = array_slice($games, 3);
                                @endphp
                                <span>{{ implode(', ', $shownGames) }}</span>
                                @if(count($remainingGames) > 0)
                                    <span class="more-dots" onclick="showFullList({{ $player->id }})" style="color: blue; cursor: pointer;">... ещё</span>
                                    <span class="full-list" style="display: none;">{{ implode(', ', $remainingGames) }}</span>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="w-1/4 px-4 py-1 text-center">{{ \Carbon\Carbon::parse($player->created_at)->format('d.m.Y') }}</td>
                    @can('update', [$player])
                    <td class="w-1/6 px-4 py-1 text-center">
                        <form action="{{ route('players.edit', $player->id) }}" method="GET" style="display:inline-block;">
                            <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded">Изменить</button>
                        </form>

                        <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('Вы уверены, что хотите удалить этого игрока?')">Удалить</button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $players->links() }}</div>
</div>

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