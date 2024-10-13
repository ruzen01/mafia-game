
<nav class="bg-gray-200 p-6 shadow-lg"> <!-- Изменили цвет фона -->
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-700">Мафия</a>
        </div>

        <!-- Центральная часть: Кнопки -->
        <div class="flex-1 text-center space-x-4">
            <a href="{{ route('games.index') }}" class="px-4 py-2 rounded hover:bg-gray-300">Игры</a>
            <a href="{{ route('players.index') }}" class="px-4 py-2 rounded hover:bg-gray-300">Игроки</a>
            <a href="{{ route('rules') }}" class="px-4 py-2 rounded hover:bg-gray-300">Правила</a>
        </div>

        <!-- Правая часть: Аутентификация -->
        <div>
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 rounded hover:bg-gray-300">Войти</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded hover:bg-gray-300">Регистрация</a>
            @else
                <a href="{{ route('profile') }}" class="px-4 py-2 rounded hover:bg-gray-300">{{ Auth::user()->name }}</a>
                <a href="{{ route('logout') }}" class="px-4 py-2 rounded hover:bg-gray-300">Выйти</a>
            @endguest
        </div>
    </div>
</nav>