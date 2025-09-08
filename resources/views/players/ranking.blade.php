@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">

    <!-- Уведомления -->
    @if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-6 shadow-lg">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-6 shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Заголовок -->
    <h1 class="text-center text-4xl font-extrabold text-gray-800 mb-8">Список игр</h1>

    <!-- Кнопка создания игры -->
    @can('create', App\Models\Game::class)
    <div class="flex justify-end mb-8">
        <a href="{{ route('games.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 font-semibold">
            🎮 Создать новую игру
        </a>
    </div>
    @endcan

    <!-- Список игр в стиле рейтинга -->
    <div class="bg-gray-100 rounded-xl shadow-xl overflow-hidden">
        <!-- Темная шапка таблицы -->
        <div class="bg-gray-800 text-white p-4 grid grid-cols-12 gap-2 font-semibold text-sm uppercase tracking-wide">
            <div class="col-span-2">Дата</div>
            <div class="col-span-3">Имя игры</div>
            <div class="col-span-1 text-center">№</div>
            <div class="col-span-2">Ведущий</div>
            <div class="col-span-1 text-center">Сезон</div>
            <div class="col-span-2">Победитель</div>
            <div class="col-span-1 text-center">Игроки</div>
        </div>

        <!-- Тело таблицы -->
        <div class="divide-y divide-gray-300">
            @foreach($games as $game)
            <div class="bg-white hover:bg-gray-50 transition-colors duration-200 group">
                <div class="p-4 grid grid-cols-12 gap-2 items-center">
                    <!-- Дата -->
                    <div class="col-span-2 text-gray-700 font-medium">
                        {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}
                    </div>
                    
                    <!-- Имя игры -->
                    <div class="col-span-3">
                        <a href="{{ route('games.show', $game->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                            {{ $game->name }}
                        </a>
                    </div>
                    
                    <!-- Номер игры -->
                    <div class="col-span-1 text-center text-gray-700 font-bold">
                        {{ $game->game_number }}
                    </div>
                    
                    <!-- Ведущий -->
                    <div class="col-span-2 text-gray-700">
                        {{ $game->host_name }}
                    </div>
                    
                    <!-- Сезон -->
                    <div class="col-span-1 text-center text-gray-700">
                        {{ $game->season }}
                    </div>
                    
                    <!-- Победитель -->
                    <div class="col-span-2 text-gray-700 font-medium">
                        {{ $game->winner }}
                    </div>
                    
                    <!-- Игроки (улучшенный выпадающий список) -->
                    <div class="col-span-1 flex justify-center">
                        <div class="relative inline-block text-left">
                            <details class="group">
                                <summary class="cursor-pointer inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <span class="text-sm font-bold text-gray-700">{{ $game->players->count() }}</span>
                                </summary>
                                
                                <!-- Выпадающий список игроков - теперь открывается вниз и показывает всех игроков -->
                                <div class="origin-top-right absolute right-0 mt-2 w-64 max-h-96 overflow-y-auto rounded-lg shadow-2xl bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="p-3">
                                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Игроки ({{ $game->players->count() }})</div>
                                        @if ($game->players->count() > 0)
                                            <div class="space-y-2">
                                                @foreach($game->players as $player)
                                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 transition-colors">
                                                        <!-- Аватар или инициалы -->
                                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-3">
                                                            <span class="text-white text-xs font-bold">
                                                                @php
                                                                    $initials = strtoupper(substr($player->name, 0, 1));
                                                                    if (str_contains($player->name, ' ')) {
                                                                        $initials .= strtoupper(substr(explode(' ', $player->name)[1], 0, 1));
                                                                    }
                                                                @endphp
                                                                {{ $initials }}
                                                            </span>
                                                        </div>
                                                        <!-- Имя игрока -->
                                                        <span class="text-sm text-gray-700">{{ $player->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="p-3 text-center text-gray-500 text-sm">Нет игроков</div>
                                        @endif
                                    </div>
                                </div>
                            </details>
                        </div>
                    </div>
                    
                    <!-- Действия -->
                    @can('update', [$game])
                    <div class="col-span-12 mt-3 pt-3 border-t border-gray-200 flex justify-end space-x-2">
                        <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1.5 px-4 rounded text-sm font-medium transition-colors duration-200">
                            ✏️ Изменить
                        </a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1.5 px-4 rounded text-sm font-medium transition-colors duration-200" onclick="return confirm('Вы уверены, что хотите удалить эту игру?')">
                                🗑️ Удалить
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection