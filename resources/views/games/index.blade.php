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
    <h1 class="text-center text-3xl font-bold mb-6">Список игр</h1>

    @can('create', App\Models\Game::class)
    <div class="flex justify-center mb-6">
        <a href="{{ route('games.create') }}" class="bg-blue-500 shadow-lg shadow-blue-500/5 hover:bg-blue-300 text-white py-2 px-4 rounded">
            Создать новую игру
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed w-full">
            <thead class="bg-gray-700 text-white sticky top-0 z-10">
                <tr>
                    <th class="truncate w-1/16 px-4 py-2 text-center">Дата</th>
                    <th class="truncate w-4/16 px-4 py-2 text-center">Имя</th>
                    <th class="truncate w-1/16 px-4 py-2 text-center">№</th>
                    <th class="truncate w-2/16 px-4 py-2 text-center">Ведущий</th>
                    <th class="truncate w-2/16 px-4 py-2 text-center">Сезон</th>
                    <th class="truncate w-2/16 px-4 py-2 text-center">Победитель</th>
                    <th class="truncate w-2/16 px-4 py-2 text-center">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="truncate w-2/16 px-4 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="bg-gray-800 text-white">
                @foreach($games as $game)
                <tr class="odd:bg-gray-800 even:bg-gray-900">
                    <td class="truncate w-1/16 px-4 py-1 text-center">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="truncate w-4/16 px-4 py-1 text-center">
                        <a href="{{ route('games.show', $game->id) }}" class="text-white hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="truncate w-1/16 px-4 py-1 text-center">{{ $game->game_number }}</td>
                    <td class="truncate w-2/16 py-2 text-center">{{ $game->host_name }}</td>
                    <td class="truncate w-2/16 px-4 py-1 text-center">{{ $game->season }}</td>
                    <td class="truncate w-2/16 px-4 py-1 text-center">{{ $game->winner }}</td>
                    <td class="truncate w-2/16 px-4 py-1 text-center"> 
                        <div class="flex items-center justify-center -space-x-2 overflow-visible">
                            @foreach($game->players->take(5) as $player) 
                                <div class="relative group flex-shrink-0"> 
                                    <img src="{{ $player->avatar_url ?? asset('images/default-avatar.png') }}" 
                                        alt="{{ $player->name }}" 
                                        class="w-8 h-8 rounded-full object-cover ring-2 ring-gray-500" 
                                        title="{{ $player->name }}"> <!-- Обводка белым для лучшей видимости на темном фоне -->
                                    <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap overflow-visible"> 
                                        {{ $player->name }} 
                                    </span> 
                                </div> 
                            @endforeach 
                            @if($game->players->count() > 5) 
                                <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-bold"> 
                                    +{{ $game->players->count() - 5 }} 
                                </div> 
                            @endif 
                        </div> 
                    </td>

                    @can('update', [$game])
                    <td class="w-2/16 px-4 py-1 text-center whitespace-nowrap">
                        <form action="{{ route('games.edit', $game->id) }}" method="GET" style="display:inline-block;">
                            <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded">Изменить</button>
                        </form>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('Вы уверены, что хотите удалить эту игру?')">
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