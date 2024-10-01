<nav class="bg-gray-800 p-6 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-400">Мафия</a>
        </div>

        <!-- Центральная часть: Кнопки "Рейтинг", "Игры", "Игроки" и "Дашборд" -->
        <div class="flex-1 text-center space-x-4">
            <a href="{{ route('games.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Игры</a>
            <a href="{{ route('players.index') }}" class="px-4 py-2 rounded hover:bg-gray-700">Игроки</a>
            <!-- Добавляем новую ссылку для перехода на страницу рейтинга -->
            <a href="{{ route('players.ranking') }}" class="px-4 py-2 rounded hover:bg-gray-700">Рейтинг</a>
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded hover:bg-gray-700">Дашборд</a>
            @endauth
        </div>

        <!-- Правая часть: Вход, Регистрация, Выход -->
        <div class="flex space-x-4">
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 hover:bg-gray-700">Вход</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">Регистрация</a>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-700 rounded hover:bg-red-700">
                        Выход
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>