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
        <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 rounded">
            Создать новую игру
        </a>
    </div>
    @endcan

    <div class="overflow-x-auto">
        <table class="table-auto border-collapse border border-gray-500 w-full">
            <thead class="text-left">
                <tr>
                    <th class="border border-gray-400 px-4 py-1">Дата</th>
                    <th class="border border-gray-400 px-4 py-1">Имя</th>
                    <th class="border border-gray-400 px-4 py-1 w-20">№</th>
                    <th class="border border-gray-400 px-4 py-1">Ведущий</th>
                    <th class="border border-gray-400 px-4 py-1">Сезон</th>
                    <th class="border border-gray-400 px-4 py-1">Победитель</th>
                    <th class="border border-gray-400 px-4 py-1">Игроки</th>
                    @can('update', App\Models\Game::class)
                    <th class="border border-gray-400 px-4 py-1">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">
                        <a href="{{ route('games.show', $game->id) }}" class="text-white hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ $game->game_number }}</td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ $game->host_name }}</td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ $game->season }}</td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ $game->winner }}</td>
                    <td class="border border-gray-400 px-4 py-1 truncate max-w-xs">{{ $game->players->pluck('name')->implode(', ') }}</td>
                    @can('update', [$game])
                    <td class="border border-gray-400 px-4 py-1">
    <div class="flex items-center space-x-2 overflow-x-auto">
        @foreach($game->players as $player)
            <div class="relative group">
                <img src="{{ $player->avatar_url ?? asset('images/default-avatar.png') }}" 
                     alt="{{ $player->name }}" 
                     class="w-8 h-8 rounded-full object-cover"
                     title="{{ $player->name }}">
                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    {{ $player->name }}
                </span>
            </div>
        @endforeach
    </div>
</td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection