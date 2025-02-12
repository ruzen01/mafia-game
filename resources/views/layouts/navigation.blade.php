<nav class="bg-gray-200 p-6 shadow-lg relative">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-700">Мафия</a>
        </div>

        <!-- Бургер-меню для мобильных устройств -->
        <div class="block sm:hidden">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Центральная часть: Кнопки "Рейтинг", "Игры", "Игроки" и "Дашборд" -->
        <div class="hidden sm:flex space-x-4">
            <div class="relative">
                <button id="dropdown-toggle" class="px-4 py-2 rounded hover:bg-gray-500">
                    Меню
                </button>
                <div id="dropdown-menu" class="absolute left-0 mt-2 w-full bg-white shadow-md rounded hidden z-10">
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
        </div>

        <!-- Правая часть: Вход, Регистрация, Выход -->
        <div class="hidden sm:flex space-x-4">
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 hover:bg-gray-500">Вход</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 rounded hover:bg-red-500">Регистрация</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-300 rounded hover:bg-red-300">
                        Выход
                    </button>
                </form>
            @endauth
        </div>

        <!-- Секция для мобильных кнопок входа/выхода -->
        <div id="auth-buttons" class="hidden sm:hidden flex flex-col space-y-2">
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 hover:bg-gray-500">Вход</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 rounded hover:bg-red-500">Регистрация</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-300 rounded hover:bg-red-300">
                        Выход
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Открытие/закрытие выпадающего меню на десктопе
    document.getElementById('dropdown-toggle').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Закрытие выпадающего меню при клике вне области
    document.addEventListener('click', function (event) {
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Открытие/закрытие бургер-меню на мобильных устройствах
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('menu');
        const authButtons = document.getElementById('auth-buttons');
        menu.classList.toggle('hidden');
        authButtons.classList.toggle('hidden');
    });
</script>