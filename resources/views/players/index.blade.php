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
        <a href="{{ route('players.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
              <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <span>Создать игрока</span>
        </a>
    </div>
    @endcan

<!-- Сетка карточек игроков -->
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center px-2 sm:px-0">
    @php
        $playersSorted = $players->sortBy('name');
    @endphp

    @foreach($playersSorted as $index => $player)
        @php
            $totalGames = $player->games->count();
            $rank = $rankMap[$player->id] ?? null;
        @endphp

    <a 
        href="{{ route('players.show', $player->id) }}" 
        class="w-48 h-64 bg-zinc-100 rounded-xl shadow-lg border-2 border-zinc-200 hover:shadow-xl hover:scale-105 transition-all duration-300 cursor-pointer relative overflow-hidden group block animate-fade-in-up"
        style="animation-delay: {{ $index * 0.1 }}s;"
    >
        <!-- Область фото с эффектом виньетки -->
        <div class="w-full h-36 p-1 relative">
            <div class="w-full h-full rounded-lg overflow-hidden relative">
                <img 
                    src="{{ $player->avatar_url }}" 
                    alt="{{ $player->name }}" 
                    class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-300"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                >
                <!-- Заглушка (светлая) -->
                <div class="absolute inset-0 flex items-center justify-center text-zinc-300 bg-zinc-50" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                      <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                    </svg>
                </div>
                <!-- Эффект виньетки (размытие по краям) -->
                <div class="absolute inset-0 pointer-events-none rounded-lg bg-gradient-to-t from-black/20 via-transparent to-black/20"></div>
            </div>
        </div>

        <!-- Имя и статистика -->
        <div class="p-3 text-center flex flex-col items-center justify-center h-28">
            <div class="font-semibold text-zinc-800 group-hover:text-blue-600 transition-colors leading-tight">
                {{ $player->name }}
            </div>
            <div class="mt-2 flex items-center justify-center space-x-2">
                <!-- Иконка + место -->
                @if($rank)
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-bar-graph text-zinc-500" viewBox="0 0 16 16">
                          <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z"/>
                          <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                        </svg>
                        <span 
                            class="text-sm font-bold"
                            @class([
                                'text-yellow-600' => $rank === 1,
                                'text-gray-500' => $rank === 2,
                                'text-amber-600' => $rank === 3,
                                'text-white bg-zinc-800 px-1 rounded' => $rank > 3, // Светлый текст на темном фоне для 4+ места
                            ])
                        >
                            {{ $rank }}
                        </span>
                    </div>
                @endif

                <!-- Разделитель -->
                <span class="text-zinc-400">•</span>

                <!-- Количество игр -->
                <div class="text-xs text-zinc-600 font-medium">
                    Игр: {{ $totalGames }}
                </div>
            </div>
        </div>
    </a>
    @endforeach
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
    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection