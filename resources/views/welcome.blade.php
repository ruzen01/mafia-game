<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать в Мафию</title>
    @vite('resources/css/app.css') <!-- Подключение стилей через Vite -->
</head>
<body class="bg-gray-900 text-white">
    <!-- Навигация -->
    <nav class="flex items-center justify-between p-6 bg-gray-800">
        <div class="text-xl font-bold">Мафия</div>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 hover:text-red-400">Вход</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">Регистрация</a>
            <a href="{{ route('rating') }}" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700">Рейтинг</a> <!-- Добавленная ссылка на рейтинг -->
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="flex items-center justify-center min-h-screen -mt-16">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Погрузитесь в мир Мафии</h1>
            <p class="text-xl mb-8">Где каждый ход может стать последним</p>
            <a href="{{ route('rules') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Узнать правила</a>
        </div>
    </main>

    <!-- Футер -->
    <footer class="text-center p-4 bg-gray-800">
        © 2024 Мафия
    </footer>
</body>
</html>