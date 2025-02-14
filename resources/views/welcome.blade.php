@extends('layouts.app')
@section('title', 'Добро пожаловать')
@section('content')
    <div class="flex items-center justify-center text-center">
        <div class="grid gap-4"> <!-- grid создает сетку, gap-4 добавляет отступы -->
            <h1 class="text-5xl font-bold mb-4">Погрузитесь в мир Мафии</h1>
            <p class="text-xl mb-8">Где каждый ход может стать последним</p>
            <a href="{{ route('rules') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-40 mx-auto">
                Правила
            </a>
            <a href="{{ route('roles') }}" class="animate-pulse bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-42 mx-auto">
                Роли
            </a>
        </div>
    </div>
@endsection