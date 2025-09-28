@extends('layouts.app')
@section('title', 'MAFIA-VDK Welcome')
@section('content')

<div class="min-h-screen flex flex-col relative overflow-hidden bg-gray-900 text-white">
    <!-- Мерцающий уличный фонарь (в правом верхнем углу) -->
    <div class="absolute top-8 right-8 w-4 h-4 rounded-full bg-yellow-300 shadow-[0_0_15px_8px_rgba(255,217,0,0.3)] opacity-80 animate-flicker"></div>

    <!-- Заголовок -->
    <div class="relative z-10 text-center mt-16 px-4">
        <h1 class="text-3xl md:text-4xl font-bold">Добро пожаловать в мир городской мафии</h1>
        <p class="mt-3 italic text-gray-300">
            где каждый ход может стать последним...
        </p>
    </div>

    <!-- Туман внизу экрана -->
    <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-gray-900 to-transparent opacity-70 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-full h-16 fog-layer"></div>

    <!-- Скрытые элементы (без ссылок) -->
    <div class="flex flex-grow items-center justify-center z-10">
        <div class="text-center text-gray-400 text-sm">
            <!-- Можно оставить пустым или добавить загадочную фразу -->
            <p>Секреты скрыты в тени...</p>
        </div>
    </div>
</div>

<style>
    /* Мерцание фонаря */
    @keyframes flicker {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
        10%, 30%, 70% { opacity: 0.85; }
        20%, 40%, 60%, 80% { opacity: 0.75; }
    }
    .animate-flicker {
        animation: flicker 3s infinite alternate;
    }

    /* Плавно движущийся туман */
    .fog-layer {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23374151' opacity='0.6'/%3E%3C/svg%3E") repeat-x;
        height: 60px;
        width: 200%;
        position: absolute;
        bottom: 0;
        left: -50%;
        animation: drift 25s linear infinite;
        opacity: 0.8;
        pointer-events: none;
    }

    @keyframes drift {
        0% { transform: translateX(0); }
        100% { transform: translateX(-1200px); }
    }
</style>

@endsection