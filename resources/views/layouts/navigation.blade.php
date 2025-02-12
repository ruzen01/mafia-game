<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Боковое меню</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <!-- Боковое меню -->
    <div id="sidebar" class="w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out sm:translate-x-0 -translate-x-full fixed inset-y-0 z-40">
        <div class="py-6 px-4 space-y-4">
            <h2 class="text-xl font-bold">Мафия</h2>
            <a href="{{ route('rules') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Правила</a>
            <a href="{{ route('roles') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Роли</a>
            <a href="{{ route('players.ranking') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Рейтинг</a>
            <a href="{{ route('games.index') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Игры</a>
            <a href="{{ route('players.index') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Игроки</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Дашборд</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left hover:bg-red-300 rounded">
                        Выход
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Вход</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Регистрация</a>
            @endauth
        </div>
    </div>

    <!-- Основной контент -->
    <div id="content" class="flex-1 ml-0 sm:ml-64 transition-all duration-300 ease-in-out">
        <nav class="bg-gray-200 p-6 shadow-lg sticky top-0 z-30">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Бургер-меню для мобильных устройств -->
                <div class="block sm:hidden">
                    <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <div class="p-6">
            <h1 class="text-2xl font-bold">Основная страница</h1>
            <p>Это пример основного контента.</p>
        </div>
    </div>

    <script>
        // Открытие/закрытие бокового меню
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');

            if (sidebar.classList.contains('-translate-x-full')) {
                // Открываем меню
                sidebar.classList.remove('-translate-x-full');
                content.style.marginLeft = '16rem'; // Размер сайдбара (w-64 = 16rem)
            } else {
                // Закрываем меню
                sidebar.classList.add('-translate-x-full');
                content.style.marginLeft = '0';
            }
        });
    </script>
</body>
</html>