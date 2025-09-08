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

    <!-- Карусель Splide -->
    <div class="splide mb-12" id="players-carousel">
        <div class="splide__track">
            <ul class="splide__list">
                @php
                    $playersSorted = $players->sortBy('name');
                @endphp

                @foreach($playersSorted as $index => $player)
                <li class="splide__slide px-2">
                    <div 
                        class="w-48 h-64 bg-white rounded-xl shadow-lg border-2 border-zinc-300 hover:shadow-xl hover:border-amber-400 transition-all duration-300 cursor-pointer relative overflow-hidden group mx-auto"
                        style="filter: sepia(30%);"
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
                            <a href="{{ route('players.edit', $player->id) }}" class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded transition">✏️</a>
                            <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded transition" onclick="return confirm('Удалить игрока {{ $player->name }}?')">
                                    🗑️
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Пагинация (оставляем, если карусель не заменяет ее полностью) -->
    <div class="mt-6 flex justify-center">
        {{ $players->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
    </div>
</div>

<!-- Анимация появления (опционально, для инициализации карусели) -->
<style>
    .splide__slide {
        display: flex;
        justify-content: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#players-carousel', {
            type   : 'loop', // Бесконечная прокрутка
            perPage: 5,      // Количество видимых карточек
            perMove: 1,      // Сколько карточек двигать за раз
            gap    : '1rem', // Расстояние между карточками
            pagination: true, // Показывать точки-индикаторы
            arrows: true,     // Показывать стрелки
            breakpoints: {
                640: { perPage: 1, gap: '0.5rem' },  // Мобильные
                768: { perPage: 2, gap: '0.75rem' }, // Планшеты
                1024: { perPage: 3, gap: '1rem' },   // Ноутбуки
                1280: { perPage: 4, gap: '1rem' },   // Десктопы
                1536: { perPage: 5, gap: '1rem' }    // Большие экраны
            }
        }).mount();
    });
</script>
@endsection