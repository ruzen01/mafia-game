<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мафия')</title>
    @vite('resources/css/app.css') <!-- Подключение стилей через Vite -->
</head>

<body class="bg-gray-900 flex flex-col h-auto text-gray-200">
    <!-- Включаем навигацию -->
    @include('layouts.navigation')

    <!-- Основной контент страницы -->
    <div class="flex-grow container mx-auto p-4">
        @yield('content')
    </div>

    <!-- Футер -->
    <footer class="text-center p-4 bg-gray-800 mt-auto">
        © 2024 Zen
    </footer>
</body>

</html>