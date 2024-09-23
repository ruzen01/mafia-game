@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Список игроков</h1>
    <div class="flex justify-center mb-4">
        <a href="{{ route('players.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Создать нового игрока</a>
    </div>
    <table class="table-auto border-collapse border border-gray-500 w-3/4 mx-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2">ID</th>
                <th class="border border-gray-400 px-4 py-2">Имя</th>
                <th class="border border-gray-400 px-4 py-2">Игры</th>
                <th class="border border-gray-400 px-4 py-2">Дата создания</th>
                <th class="border border-gray-400 px-4 py-2">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td class="border border-gray-400 px-4 py-2">{{ $player->id }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->name }}</td>
                <td class="border border-gray-400 px-4 py-2">
                    @if($player->games->isEmpty())
                        Нет игр
                    @else
                        @foreach($player->games as $game)
                            <span>{{ $game->name }}</span><br>
                        @endforeach
                    @endif
                </td>
                <td class="border border-gray-400 px-4 py-2">{{ $player->created_at }}</td>
                <td class="border border-gray-400 px-4 py-2">
                    <a href="{{ route('players.edit', $player) }}" class="bg-yellow-500 text-white py-1 px-2 rounded">Изменить</a>
                    <form action="{{ route('players.destroy', $player) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection