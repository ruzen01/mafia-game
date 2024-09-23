@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-center text-3xl font-bold mb-6">Подробная информация об игре: {{ $game->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <!-- Основная информация об игре -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-lg"><strong>Дата игры:</strong> {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y') }}</p>
            </div>
            <div>
                <p class="text-lg"><strong>Номер игры:</strong> {{ $game->game_number }}</p>
            </div>
            <div>
                <p class="text-lg"><strong>Ведущий:</strong> {{ $game->host_name }}</p>
            </div>
            <div>
                <p class="text-lg"><strong>Победитель:</strong> {{ $game->winner }}</p>
            </div>
        </div>

        <!-- Игроки -->
        <div class="mb-4">
            <p class="text-lg font-semibold"><strong>Игроки:</strong></p>
            <p class="text-gray-700">
                @if($game->players->isNotEmpty())
                    {{ $game->players->pluck('name')->implode(', ') }}
                @else
                    <span class="text-red-500">Нет игроков</span>
                @endif
            </p>
        </div>

        <!-- Игроки и их баллы -->
        <div>
            <p class="text-lg font-semibold mb-2"><strong>Игроки и их баллы:</strong></p>
            <ul class="list-disc pl-5 text-gray-700">
                @if($game->players)
                    @foreach($game->players as $player)
                    <li class="mb-2">
                        <strong>{{ $player->name }}:</strong> 
                        {{ $player->pivot->score }} баллов, 
                        <span class="italic">Лучший игрок:</span> {{ $player->pivot->best_player ? 'Да' : 'Нет' }}, 
                        <span class="italic">Первая жертва:</span> {{ $player->pivot->first_victim ? 'Да' : 'Нет' }}, 
                        <span class="italic">Баллы от ведущего:</span> {{ $player->pivot->leader_score }},
                        <span class="italic">Дополнительный балл:</span> {{ $player->pivot->additional_score ? 'Да' : 'Нет' }}, 
                        <span class="italic">Комментарий:</span> {{ $player->pivot->comment ?? 'Нет' }}
                    </li>
                    @endforeach
                @else
                    <li>Нет игроков</li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Кнопки для редактирования и удаления игры -->
    <div class="flex justify-between">
        <a href="{{ route('games.edit', $game) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition duration-300">
            Изменить
        </a>

        <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить игру?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-300">
                Удалить
            </button>
        </form>
    </div>
</div>
@endsection