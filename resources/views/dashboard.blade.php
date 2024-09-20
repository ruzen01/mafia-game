@extends('layouts.app')

@section('title', 'Дашборд')

@section('content')
<div class="container mx-auto p-4">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold">Добро пожаловать, {{ Auth::user()->name }}!</h1>
        <p class="text-xl text-gray-400">Ваш личный дашборд</p>
    </div>

    <!-- Основная информация пользователя -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <!-- Статистика пользователя -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Статистика</h2>
            <ul class="space-y-2">
                <li>Игры сыграно: <span class="font-bold">12</span></li>
                <li>Победы: <span class="font-bold">8</span></li>
                <li>Поражения: <span class="font-bold">4</span></li>
                <li>Текущий рейтинг: <span class="font-bold">1500</span></li>
            </ul>
        </div>

        <!-- Действия -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center">
            <h2 class="text-2xl font-bold mb-4">Действия</h2>
            <a href="{{ route('game.new') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Начать новую игру</a>
            <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-gray-300">Настройки профиля</a>
        </div>

        <!-- Лидерборд -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Топ игроков</h2>
            <ol class="list-decimal list-inside space-y-2">
                <li>Игрок 1 — 1600 очков</li>
                <li>Игрок 2 — 1580 очков</li>
                <li>Игрок 3 — 1550 очков</li>
            </ol>
        </div>
    </div>

    <!-- Новости или события -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Новости и события</h2>
        <p class="text-gray-400">Новый турнир стартует 10 октября! Зарегистрируйтесь и участвуйте, чтобы выиграть призы.</p>
    </div>
</div>
@endsection