<nav class="bg-gray-200 p-6 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-700">Мафия</a>
        </div>

        <!-- Центральная часть: Кнопки "Рейтинг", "Игры", "Игроки" и "Дашборд" -->
        <div class="flex-1 text-center space-x-4">
            <!-- Добавляем новую ссылку для перехода на страницу рейтинга -->
            <a href="{{ route('players.ranking') }}" class="px-4 py-2 rounded hover:bg-gray-500">Рейтинг</a>
            <a href="{{ route('games.index') }}" class="px-4 py-2 rounded hover:bg-gray-500">Игры</a>
            <a href="{{ route('players.index') }}" class="px-4 py-2 rounded hover:bg-gray-500">Игроки</a>
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded hover:bg-gray-500">Дашборд</a>
            @endauth
        </div>

        <!-- Правая часть: Вход, Регистрация, Выход -->
        <div class="flex space-x-4">
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