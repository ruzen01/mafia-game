<nav class="bg-gray-200 p-6 shadow-lg relative z-50">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-700">Мафия</a>
        </div>

        <!-- Горизонтальное меню для десктопа -->
        <div class="hidden sm:flex space-x-4">
            <a href="{{ route('rules') }}" class="hover:text-gray-700">Правила</a>
            <a href="{{ route('roles') }}" class="hover:text-gray-700">Роли</a>
            <a href="{{ route('players.ranking') }}" class="hover:text-gray-700">Рейтинг</a>
            <a href="{{ route('games.index') }}" class="hover:text-gray-700">Игры</a>
            <a href="{{ route('players.index') }}" class="hover:text-gray-700">Игроки</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Дашборд</a>
            @endauth
        </div>

        <!-- Бургер-меню для мобильных устройств -->
        <div class="sm:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Сайдбар (боковое меню) -->
<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-40">
    <div class="py-6 px-4 space-y-2">
        <a href="{{ route('rules') }}" class="block px-4 py-2 hover:bg-gray-100">Правила</a>
        <a href="{{ route('roles') }}" class="block px-4 py-2 hover:bg-gray-100">Роли</a>
        <a href="{{ route('players.ranking') }}" class="block px-4 py-2 hover:bg-gray-100">Рейтинг</a>
        <a href="{{ route('games.index') }}" class="block px-4 py-2 hover:bg-gray-100">Игры</a>
        <a href="{{ route('players.index') }}" class="block px-4 py-2 hover:bg-gray-100">Игроки</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Дашборд</a>
        @endauth
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