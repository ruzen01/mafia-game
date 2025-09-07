@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">

    <!-- Уведомления -->
    @if(session('error'))
        <div class="absolute left-0 bg-red-500 text-white p-3 rounded mb-4" style="top: 100px; z-index: 10;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="absolute left-0 bg-green-500 text-white p-3 rounded mb-4" style="top: 100px; z-index: 10;">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Список игроков</h1>

    @can('create', App\Models\Player::class)
    <div class="flex justify-center mb-6">
        <a href="{{ route('players.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition">
            Создать игрока
        </a>
    </div>
    @endcan

    <!-- Таблица игроков -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-fixed border-collapse w-full bg-zinc-200 text-sm">
            <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                <tr>
                    <th class="border border-zinc-500 w-8 px-1 py-2 text-center">№</th>
                    <th class="border border-zinc-500 px-2 py-2 text-left">Имя игрока</th>
                    @can('update', App\Models\Player::class)
                    <th class="border border-zinc-500 w-24 px-1 py-2 text-center text-gray-300">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @php
                    $playersSorted = $players->sortBy('name'); // По алфавиту
                    $index = 1;
                @endphp

                @foreach($playersSorted as $player)
                <tr class="bg-zinc-200 hover:bg-zinc-300 transition-colors duration-150">
                    <td class="border border-zinc-500 w-8 px-1 py-1 text-center text-zinc-700">
                        {{ $index++ }}
                    </td>
                    <td class="border border-zinc-500 px-2 py-1 min-w-0">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="block truncate font-semibold text-zinc-800 hover:text-blue-600"
                           title="{{ $player->name }}">
                            {{ $player->name }}
                        </a>
                    </td>
                    @can('update', [$player])
                    <td class="border border-zinc-500 w-24 px-1 py-1 text-center space-y-1">
                        <form action="{{ route('players.edit', $player->id) }}" method="GET" class="inline-block">
                            <button type="submit" class="bg-yellow-500 text-white text-xs py-1 px-2 rounded hover:bg-yellow-600 transition">
                                Изменить
                            </button>
                        </form>
                        <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs py-1 px-2 rounded hover:bg-red-600 transition" onclick="return confirm('Удалить игрока {{ $player->name }}?')">
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

    <!-- Пагинация -->
    <div class="mt-6 flex justify-center">
        {{ $players->appends(request()->query())->links() }}
    </div>
</div>
@endsection