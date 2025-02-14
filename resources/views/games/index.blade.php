@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    @if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-center text-4xl font-extrabold text-gray-800 mb-6">Список игр</h1> <!-- Увеличил размер заголовка и сделал его темнее -->

    @can('create', App\Models\Game::class)
    <div class="flex justify-right mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 shadow-lg shadow-blue-500/5 hover:bg-blue-300 text-white py-2 px-4 rounded">
            Создать новую игру
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-auto w-full">
            <thead class="bg-gray-300 text-gray-900 text-left"> <!-- Темнее для заголовков таблицы -->
                <tr>
                    <th class="truncate px-4 py-2">Дата</th>
                    <th class="truncate px-4 py-2">Имя</th>
                    <th class="truncate px-4 py-2">№</th>
                    <th class="truncate px-4 py-2">Ведущий</th>
                    <th class="truncate px-4 py-2">Сезон</th>
                    <th class="truncate px-4 py-2">Победитель</th>
                    <th class="truncate px-4 py-2">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="truncate px-4 py-2">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300"> <!-- Чередующиеся строки с легким выделением при наведении -->
                    <td class="truncate px-4 py-2">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="truncate max-w-xs px-4 py-2">
                        <a href="{{ route('games.show', $game->id) }}" class="hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="truncate px-4 py-2">{{ $game->game_number }}</td>
                    <td class="truncate px-4 py-2">{{ $game->host_name }}</td>
                    <td class="truncate px-4 py-2">{{ $game->season }}</td>
                    <td class="truncate px-4 py-2">{{ $game->winner }}</td>
                    <td class="px-4 py-2">
    <div class="relative inline-block text-left">
        <!-- Кнопка для открытия списка -->
        <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-haspopup="true" aria-expanded="false" data-dropdown-toggle>
            Игроки
            <!-- Иконка стрелки -->
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Выпадающий список -->
        <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="players-dropdown" data-dropdown>
            <div class="py-1" role="none">
                @foreach($game->players as $player)
                <div class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    <!-- Аватар или инициалы игрока -->
                    <div class="flex-shrink-0 flex items-center justify-center w-6 h-6 mr-2 rounded-full bg-blue-500 text-white font-bold">
                        @php
                        // Получение инициалов
                        $initials = strtoupper(substr($player->name, 0, 1));
                        if (str_contains($player->name, ' ')) {
                            $initials .= strtoupper(substr(explode(' ', $player->name)[1], 0, 1));
                        }
                        @endphp
                        {{ $initials }}
                    </div>
                    <!-- Имя игрока -->
                    {{ $player->name }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</td>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Добавляем обработчики для всех кнопок "Игроки"
        document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
            const dropdown = button.nextElementSibling;

            // Открываем/закрываем выпадающий список
            button.addEventListener('click', function (event) {
                event.stopPropagation(); // Предотвращаем распространение события
                if (dropdown) {
                    dropdown.classList.toggle('hidden'); // Переключаем видимость списка
                    button.setAttribute('aria-expanded', !dropdown.classList.contains('hidden')); // Обновляем атрибут aria-expanded
                }
            });
        });

        // Закрытие списка при клике вне элемента
        document.addEventListener('click', function (event) {
            document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
                const toggleButton = dropdown.previousElementSibling;

                if (!dropdown.contains(event.target) && !toggleButton.contains(event.target)) {
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden'); // Скрываем список
                        if (toggleButton) {
                            toggleButton.setAttribute('aria-expanded', 'false'); // Обновляем атрибут aria-expanded
                        }
                    }
                }
            });
        });
    });
</script>
                    @can('update', [$game])
                    <td class="truncate px-4 py-2">
                        <form action="{{ route('games.edit', $game->id) }}" method="GET" style="display:inline-block;">
                            <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-400">Изменить</button>
                        </form>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-400" onclick="return confirm('Вы уверены, что хотите удалить эту игру?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection