@extends('layouts.app')
@section('title', 'MAFIA-VDK Welcome')
@section('content')

<div class="min-h-screen flex flex-col"> <!-- Основной контейнер -->
    <!-- Заголовок -->
    <h1 class="text-center text-3xl font-bold mt-8">Добро пожаловать в мир городской мафии</h1>
    <p class="text-center italic bg-clip-text text-transparent bg-gradient-to-r from-zinc-900 to-zinc-400 mt-2">
        где каждый ход может стать последним...
    </p>

    <!-- Блок со ссылками, центрированный по вертикали и горизонтали -->
    <div class="flex flex-grow items-center justify-center"> <!-- Центрирующий контейнер -->
        <div class="text-center"> <!-- Блок со ссылками -->
            <a href="{{ route('rules') }}">
                <p class="cursor-pointer">Правила</p>
            </a>
            <a href="{{ route('roles') }}" class="cursor-pointer">
                <p class="mt-2">Роли</p>
            </a>
        </div>
    </div>
</div>

@endsection