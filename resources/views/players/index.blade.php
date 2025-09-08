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

    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Игроки</h1>

    @can('create', App\Models\Player::class)
    <div class="flex justify-center mb-8">
        <a href="{{ route('players.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition transform hover:scale-105 shadow-md">
            🃏 Создать игрока
        </a>
    </div>
    @endcan

<!-- Сетка карточек игроков -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center">
    @php
        $playersSorted = $players->sortBy('name');
    @endphp

    @foreach($playersSorted as $index => $player)
    <div 
        class="w-48 h-64 bg-white rounded-xl shadow-lg border-2 border-zinc-300 hover:shadow-xl hover:scale-105 hover:border-amber-400 transition-all duration-300 cursor-pointer relative overflow-hidden group"
        style="animation-delay: {{ $index * 0.1 }}s; filter: sepia(30%);"
    >
        <!-- Фото игрока или заглушка -->
        <div class="w-full h-36 flex items-center justify-center overflow-hidden bg-white">
            @if($player->photo_path)
                <img src="{{ asset('storage/' . $player->photo_path) }}" alt="{{ $player->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @else
                <div class="text-5xl text-zinc-300">👤</div>
            @endif
        </div>

        <!-- Имя игрока -->
        <div class="p-3 flex flex-col items-center h-20 justify-center">
            <a href="{{ route('players.show', $player->id) }}" class="text-sm font-medium text-zinc-700 text-center hover:text-amber-700 line-clamp-2 leading-tight transition-colors">
                {{ $player->name }}
            </a>
        </div>

        <!-- Панель действий (появляется при наведении) -->
        @can('update', [$player])
        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white text-xs flex justify-around py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-8 group-hover:translate-y-0">
            <!-- Кнопка редактирования с SVG иконкой -->
            <a href="{{ route('players.edit', $player->id) }}" class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded transition flex items-center justify-center w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </a>
            <!-- Кнопка удаления с SVG иконкой -->
            <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded transition flex items-center justify-center w-8 h-8" onclick="return confirm('Удалить игрока {{ $player->name }}?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
            </form>
        </div>
        @endcan
    </div>
    @endforeach
</div>

    <!-- Пагинация -->
    <div class="mt-12 flex justify-center">
        {{ $players->appends(request()->query())->links() }}
    </div>
</div>

<!-- Анимация появления для карточек -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .animate-fade-in {
        animation: fade-in-up 0.6s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection