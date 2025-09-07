@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">

    <!-- Уведомления -->
    @if(session('error'))
        <div class="absolute left-0 bg-red-500 text-white p-3 rounded mb-4 animate-fade-in" style="top: 100px; z-index: 10;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="absolute left-0 bg-green-500 text-white p-3 rounded mb-4 animate-fade-in" style="top: 100px; z-index: 10;">
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
                    <th class="border border-zinc-500 px-2 py-2 text-left">Игрок</th>
                    @can('update', App\Models\Player::class)
                    <th class="border border-zinc-500 w-24 px-1 py-2 text-center text-gray-300">Действия</th>
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-500">
                @php
                    // Сортировка по алфавиту
                    $sortedPlayers = $players->sortBy('name');
                    $rank = 1;
                @endphp

                @foreach($sortedPlayers as $player)
                <tr 
                    class="
                        bg-zinc-200
                        @if($rank <= 3) border border-zinc-400 @endif
                        animate-fade-in
                        hover:bg-zinc-300 transition-colors duration-150
                    "
                    style="animation-delay: {{ $rank * 0.1 }}s"
                >
                    <!-- Место -->
                    <td class="border border-zinc-500 w-8 px-1 py-1 text-center">
                        @if($rank <= 3)
                            <div class="flex justify-center">
                                @if($rank == 1)
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                @elseif($rank == 2)
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                @elseif($rank == 3)
                                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                @endif
                            </div>
                        @else
                            <span class="text-zinc-700 text-sm">{{ $rank }}</span>
                        @endif
                    </td>

                    <!-- Имя игрока -->
                    <td class="border border-zinc-500 px-2 py-1 min-w-0">
                        <a href="{{ route('players.show', $player->id) }}"
                           class="
                                block truncate font-semibold
                                @if($rank == 1) text-pink-700 @endif
                                @if($rank == 2) text-violet-700 @endif
                                @if($rank == 3) text-blue-700 @endif
                                @if($rank > 3) text-zinc-800 @endif
                                hover:underline
                           "
                           style="font-family: @if($rank <= 3) 'Poppins', sans-serif @endif"
                           title="{{ $player->name }}">
                            {{ $player->name }}
                        </a>
                    </td>

                    <!-- Действия -->
                    @can('update', [$player])
                    <td class="border border-zinc-500 w-24 px-1 py-1 text-center space-y-1">
                        <form action="{{ route('players.edit', $player->id) }}" method="GET" class="inline-block">
                            <button type="submit" class="bg-yellow-500 text-white py-1 px-2 rounded text-xs hover:bg-yellow-600 transition">
                                Изменить
                            </button>
                        </form>
                        <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded text-xs hover:bg-red-600 transition" onclick="return confirm('Удалить игрока {{ $player->name }}?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @php $rank++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    <div class="mt-6 flex justify-center">
        {{ $players->appends(request()->query())->links() }}
    </div>
</div>

<!-- Анимация появления -->
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection