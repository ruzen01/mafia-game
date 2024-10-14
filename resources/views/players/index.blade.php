@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">

    @if(session('error'))
        <div class="absolute left-0 bg-red-500 text-white p-3 rounded mb-4" style="top: 100px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="absolute left-0 bg-green-500 text-white p-3 rounded mb-4" style="top: 100px;">
            {{ session('success') }}
        </div>
    @endif

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
            <thead class="bg-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="w-1/4 px-4 py-2 text-center">Имя</th>
                    <th class="w-1/3 px-4 py-2 text-center">Игры</th>
                    <th class="w-1/4 px-4 py-2 text-center">Дата создания</th>
                    @can('update', App\Models\Player::class)
                    <th class="w-1/6 px-4 py-2 text-center">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="bg-gray-800">
                @foreach($players as $player)
                <tr class="odd:bg-gray-100 even:bg-gray-200">
                    <td class="w-1/4 px-4 py-1 truncate">
                        <a href="{{ route('players.show', $player->id) }}" class="hover:text-blue-500">
                            {{ $player->name }}
                        </a>
                    </td>
                    <td class="w-1/3 px-4 py-1 truncate">
                        {{ implode(', ', $player->games->pluck('name')->toArray()) }}
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
@endsection