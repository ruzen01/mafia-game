@extends('layouts.app')

@section('title', 'Список игр')

@section('content')
<h1 class="text-2xl font-bold mb-4">Список игр</h1>

<a href="{{ route('games.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Добавить новую игру</a>

<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="text-left px-4 py-2">Название игры</th>
            <th class="text-left px-4 py-2">Дата</th>
            <th class="text-left px-4 py-2">Номер игры</th>
            <th class="text-left px-4 py-2">Ведущий</th>
            <th class="text-left px-4 py-2">Результат</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
        <tr>
            <td class="border px-4 py-2">{{ $game->name }}</td>
            <td class="border px-4 py-2">{{ $game->date->format('Y-m-d') }}</td>
            <td class="border px-4 py-2">{{ $game->game_number }}</td>
            <td class="border px-4 py-2">{{ $game->host_name }}</td>
            <td class="border px-4 py-2">{{ $game->result }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection