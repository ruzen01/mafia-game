@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-2">
    <!-- Заголовок страницы -->
    <h1 class="text-center text-2xl sm:text-3xl font-bold mb-6 text-zinc-800">Подробная информация об игре: {{ $game->name }}</h1>

    <!-- Основная информация об игре -->
    <div class="shadow-lg rounded-lg bg-zinc-200 p-6 mb-6">
        <table class="table-auto border-collapse border border-zinc-400 w-full mb-6 text-xs sm:text-sm">
            <tbody class="bg-zinc-100">
                <tr>
                    <th class="border border-zinc-300 px-3 py-2 text-left font-semibold text-zinc-700">Дата игры:</th>
                    <td class="border border-zinc-300 px-3 py-2">{{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</td>
                </tr>
                <tr>
                    <th class="border border-zinc-300 px-3 py-2 text-left font-semibold text-zinc-700">Номер игры:</th>
                    <td class="border border-zinc-300 px-3 py-2 font-semibold text-blue-700">{{ $game->game_number }}</td>
                </tr>
                <tr>
                    <th class="border border-zinc-300 px-3 py-2 text-left font-semibold text-zinc-700">Ведущий:</th>
                    <td class="border border-zinc-300 px-3 py-2">{{ $game->host_name }}</td>
                </tr>
                <tr>
                    <th class="border border-zinc-300 px-3 py-2 text-left font-semibold text-zinc-700">Сезон:</th>
                    <td class="border border-zinc-300 px-3 py-2 text-slate-700">{{ $game->season }}</td>
                </tr>
                <tr>
                    <th class="border border-zinc-300 px-3 py-2 text-left font-semibold text-zinc-700">Победитель:</th>
                    <td class="border border-zinc-300 px-3 py-2 text-green-700 font-bold">{{ $game->winner }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Таблица игроков -->
        <h3 class="text-xl font-semibold mb-4 text-zinc-800">Игроки и их баллы:</h3>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="table-auto border-collapse border border-zinc-300 w-full text-xs sm:text-sm">
                <thead class="bg-zinc-700 text-zinc-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="border border-zinc-300 px-3 py-2 text-left">Игрок</th>
                        <th class="border border-zinc-300 px-3 py-2 text-left">Роль</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-amber-300">Р</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-blue-300">БЛ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-red-300">ПУ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-purple-300">ДБ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-center text-slate-300">БВ</th>
                        <th class="border border-zinc-300 px-3 py-2 text-left">Комментарий</th>
                    </tr>
                </thead>
                <tbody class="bg-zinc-100 divide-y divide-zinc-300">
                    @foreach($game->players as $player)
                    <tr class="hover:bg-zinc-200 transition">
                        <td class="border border-zinc-300 px-3 py-2 font-medium text-zinc-800">{{ $player->name }}</td>
                        <td class="border border-zinc-300 px-3 py-2 text-zinc-600">
                            {{ $roles[$player->pivot->role_id] ?? 'Не назначена' }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-center font-bold text-amber-700">
                            {{ $player->pivot->score }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-center text-blue-700">
                            {{ $player->pivot->best_player ? '★' : '' }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-center text-red-700">
                            {{ $player->pivot->first_victim ? '💀' : '' }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-center text-purple-700">
                            {{ $player->pivot->additional_score ? '➕' : '' }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-center text-slate-700">
                            {{ $player->pivot->leader_score }}
                        </td>
                        <td class="border border-zinc-300 px-3 py-2 text-zinc-700">
                            {{ $player->pivot->comment ?? '—' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Кнопки действий — только для админов -->
    @canany(['update', 'delete'], $game)
    <div class="flex justify-center gap-3 mt-6 flex-wrap">
        @can('update', $game)
        <a href="{{ route('games.edit', $game) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2"
           title="Редактировать">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 1 1-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            <span>Изменить</span>
        </a>
        @endcan

        @can('delete', $game)
        <form action="{{ route('games.destroy', $game) }}" method="POST" class="inline-block" onsubmit="return confirm('Вы уверены, что хотите удалить игру?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2"
                    title="Удалить">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
                <span>Удалить</span>
            </button>
        </form>
        @endcan
    </div>
    @endcanany
</div>
@endsection