@extends('layouts.app')
@section('title', 'MAFIA-VDK Welcome')
@section('content')
    <div class="flex items-center justify-center text-center">
        <div class="grid gap-4 md:grid-cols-2"> <!-- На мобильном одна колонка, на десктопе две -->
            <h1 class="text-2xl font-bold mb-4 md:col-span-2">Добро пожаловать<br>в мир городской мафии</h1>
            <p class="mb-2 bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-400 md:col-span-2">
                Где каждый ход может стать последним
            </p>

            <!-- Миниатюра для ссылки "Правила" -->
            <a href="{{ route('rules') }}" class="block bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-64 mx-auto overflow-hidden md:w-full">
                <img src="{{ asset('images/rules.jpg') }}" alt="Правила" class="w-full h-32 object-cover">
                <span class="block mt-2">Правила</span>
            </a>

            <!-- Миниатюра для ссылки "Роли" -->
            <a href="{{ route('roles') }}" class="block animate-pulse bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-64 mx-auto overflow-hidden md:w-full">
                <img src="{{ asset('images/roles.jpg') }}" alt="Роли" class="w-full h-32 object-cover">
                <span class="block mt-2">Роли</span>
            </a>
        </div>
    </div>
@endsection