<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мафия')</title>
    @vite('resources/css/app.css') <!-- Подключение стилей через Vite -->
</head>

<body class="bg-gray-100 flex flex-col min-h-screen text-gray-900"> <!-- Изменили фон и текст -->
    <!-- Включаем навигацию -->
    @include('layouts.navigation')

    <!-- Основной контент страницы -->
    <div class="flex flex-col flex-grow container mx-auto p-4">
        @yield('content')
    </div>

    <!-- Футер -->
    <footer class="text-center p-4 bg-gray-200 mt-auto"> <!-- Изменили цвет фона футера -->
        © 2024 Zen
    </footer>
</body>

</html>