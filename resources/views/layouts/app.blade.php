<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мафия')</title>
    @vite('resources/css/app.css') <!-- Подключение стилей через Vite -->
</head>
    <body class="bg-gray-900">
        <!-- Включаем навигацию -->
        @include('layouts.navigation')

        <!-- Основной контент страницы -->
        <div class="container mx-auto p-4 text-white">
            @yield('content')
        </div>

        <!-- Футер -->
        <footer class="text-center p-4 bg-gray-800">
            © 2024 Мафия
        </footer>
    </body>
</html>