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
                    <td class="border border-gray-400 px-4 py-1">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                    <td class="border border-gray-400 px-4 py-1">
                        <a href="{{ route('games.show', $game->id) }}" class="text-white hover:text-blue-500">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td class="border border-gray-400 px-4 py-1">{{ $game->game_number }}</td>
                    <td class="border border-gray-400 px-4 py-1">{{ $game->host_name }}</td>
                    <td class="border border-gray-400 px-4 py-1">{{ $game->season }}</td>
                    <td class="border border-gray-400 px-4 py-1">{{ $game->winner }}</td>
                    <td class="border border-gray-400 px-4 py-1">{{ $game->players->pluck('name')->implode(', ') }}</td>
                    @can('update', [$game])
                    <td class="border border-gray-400 px-4 py-1 text-center">
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