@extends('layouts.app')
@section('title', 'MAFIA-VDK Welcome')
@section('content')
<div class="text-center">
    <h1 class="text-2xl font-bold md:col-span-3 mb-4">Добро пожаловать в мир городской мафии</h1>
    <p class="mb-8 bg-clip-text text-transparent bg-gradient-to-r from-zinc-900 to-zinc-400 md:col-span-3">
        Где каждый ход может стать последним...
    </p>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto max-w-4xl">
        <!-- Миниатюра для ссылки "Правила" -->
        <a href="{{ route('rules') }}" class="cursor-pointer transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
            <img src="{{ asset('images/rules.jpg') }}" alt="Правила" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Правила</p>
        </a>

        <!-- Миниатюра для ссылки "Роли" -->
        <a href="{{ route('roles') }}" class="cursor-pointer">
            <img src="{{ asset('images/welcome/roles.webp') }}" alt="Роли" class="w-full h-32 object-cover rounded-lg border border-gray-300  transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:sepia">
            <p class="text-center mt-2">Роли</p>
        </a>
    </div>
</div>
@endsection