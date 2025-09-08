<!-- Блок навигации (закрепленный наверху для широких экранов) -->
<nav class="bg-zinc-800 py-3 px-4 shadow-lg sticky top-0 z-50" id="navbar">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название с анимацией -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="text-white hover:text-red-400 transition-all duration-300 transform hover:scale-105 hover:animate-pulse">
                MAFIA-VDK
            </a>
        </div>

        <!-- Горизонтальное меню для десктопа -->
        <div class="hidden sm:flex flex-grow justify-center space-x-4">
            <a href="{{ route('rules') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Правила</a>
            <a href="{{ route('roles') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Роли</a>
            <a href="{{ route('players.ranking') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Рейтинг</a>
            <a href="{{ route('games.index') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Игры</a>
            <a href="{{ route('players.index') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Игроки</a>
            <a href="{{ route('contacts') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Контакты</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-white hover:text-zinc-300 transition-colors duration-200">Дашборд</a>
            @endauth
        </div>

        <!-- Кнопки авторизации для десктопа -->
        <div class="hidden sm:flex items-center space-x-3">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 text-sm bg-zinc-700 text-white hover:bg-zinc-600 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-600">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 py-1.5 text-sm bg-zinc-700 text-white hover:bg-zinc-600 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-600">Войти</a>
                <a href="{{ route('register') }}" class="px-3 py-1.5 text-sm bg-zinc-800 text-white hover:bg-zinc-700 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-700">Регистрация</a>
            @endauth
        </div>

        <!-- Бургер-меню для мобильных устройств -->
        <div class="sm:hidden">
            <button id="menu-toggle" class="text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Сайдбар (боковое меню) -->
<div id="sidebar" class="fixed left-0 w-64 bg-zinc-700 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-40 top-[56px] bottom-0 overflow-y-auto">
    <div class="pt-6 pb-20 px-4 space-y-2">
        <a href="{{ route('rules') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Правила</a>
        <a href="{{ route('roles') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Роли</a>
        <a href="{{ route('players.ranking') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Рейтинг</a>
        <a href="{{ route('games.index') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Игры</a>
        <a href="{{ route('players.index') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Игроки</a>
        <a href="{{ route('contacts') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Контакты</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-white hover:bg-zinc-600 rounded transition-colors duration-200">Дашборд</a>
        @endauth
    </div>

    <!-- Кнопки авторизации для мобильных -->
    <div class="absolute bottom-0 w-full border-t border-zinc-600 py-4 px-4 space-y-3">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-sm bg-zinc-800 text-white hover:bg-red-600 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="w-full px-4 py-2 text-sm bg-zinc-800 text-white hover:bg-zinc-600 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-600">Войти</a>
            <a href="{{ route('register') }}" class="w-full px-4 py-2 text-sm bg-zinc-800 text-white hover:bg-zinc-700 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-700">Регистрация</a>
        @endauth
    </div>
</div>

<script>
    // Открытие/закрытие бокового меню
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content'); // Этот элемент должен быть в вашем основном шаблоне

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function () {
            const isClosed = sidebar.classList.contains('-translate-x-full');

            if (isClosed) {
                // Открываем меню
                sidebar.classList.remove('-translate-x-full');
                if (content) content.style.marginLeft = '16rem'; // 16rem = w-64
            } else {
                // Закрываем меню
                sidebar.classList.add('-translate-x-full');
                if (content) content.style.marginLeft = '0';
            }
        });

        // Автоматическое закрытие меню при изменении размера окна
        window.addEventListener('resize', function () {
            if (!sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
                if (content) content.style.marginLeft = '0';
            }
        });
    }
</script>