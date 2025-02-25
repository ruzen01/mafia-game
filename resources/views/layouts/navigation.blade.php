<!-- Блок навигации (закрепленный наверху для широких экранов) -->
<nav class="bg-gray-200 p-6 shadow-lg sticky top-0 z-50" id="navbar">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
         
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-700">MAFIA-VDK</a>
        </div>

        <!-- Горизонтальное меню для десктопа -->
        <div class="hidden sm:flex flex-grow justify-center space-x-4">
            <a href="{{ route('rules') }}" class="hover:text-gray-700">Правила</a>
            <a href="{{ route('roles') }}" class="hover:text-gray-700">Роли</a>
            <a href="{{ route('players.ranking') }}" class="hover:text-gray-700">Рейтинг</a>
            <a href="{{ route('games.index') }}" class="hover:text-gray-700">Игры</a>
            <a href="{{ route('players.index') }}" class="hover:text-gray-700">Игроки</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Дашборд</a>
            @endauth
        </div>

        <!-- Кнопки авторизации для десктопа -->
        <div class="hidden sm:flex items-center space-x-4">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-zinc-400 text-white hover:bg-zinc-500 rounded focus:outline-none">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-zinc-400 text-white hover:bg-zinc-500 rounded focus:outline-none">Войти</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-zinc-500 text-white hover:bg-zinc-600 rounded focus:outline-none">Регистрация</a>
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
<div id="sidebar" class="fixed left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-40 top-[64px] bottom-0 overflow-y-auto">
    <div class="pt-4 px-4 space-y-2">
        <a href="{{ route('rules') }}" class="block px-4 py-2 pt-4 hover:bg-gray-100">Правила</a>
        <a href="{{ route('roles') }}" class="block px-4 py-2 hover:bg-gray-100">Роли</a>
        <a href="{{ route('players.ranking') }}" class="block px-4 py-2 hover:bg-gray-100">Рейтинг</a>
        <a href="{{ route('games.index') }}" class="block px-4 py-2 hover:bg-gray-100">Игры</a>
        <a href="{{ route('players.index') }}" class="block px-4 py-2 hover:bg-gray-100">Игроки</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Дашборд</a>
        @endauth
    </div>

    <!-- Кнопки авторизации для мобильных -->
    <div class="absolute bottom-0 w-full border-t border-gray-200 py-4 px-4 space-y-2">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-zinc-400 text-white hover:bg-zinc-500 rounded focus:outline-none">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="w-full px-4 py-2 bg-zinc-400 text-white hover:bg-zinc-500 rounded focus:outline-none">Войти</a>
            <a href="{{ route('register') }}" class="w-full px-4 py-2 bg-zinc-500 text-white hover:bg-zinc-600 rounded focus:outline-none">Регистрация</a>
        @endauth
    </div>
</div>

<script>
    // Открытие/закрытие бокового меню
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    menuToggle.addEventListener('click', function () {
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

    // Автоматическое закрытие меню при изменении ориентации или размера окна
    window.addEventListener('resize', function () {
        if (!sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            content.style.marginLeft = '0';
        }
    });
</script>