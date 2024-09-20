<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мафия')</title>
    @vite('resources/css/app.css') <!-- Подключение стилей через Vite -->
    @stack('styles')
</head>
<body class="@yield('bodyClass', 'bg-gray-900 text-white flex flex-col min-h-screen')">
    <!-- Включаем навигацию -->
    @include('layouts.navigation')

    <!-- Основной контент страницы -->
    <div class="flex-grow">
        @yield('content')
    </div>

    <!-- Футер -->
    <footer class="text-center p-4 bg-gray-800 mt-auto">
        © 2024 Мафия
    </footer>
</body>
</html>