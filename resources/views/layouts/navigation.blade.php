<nav class="bg-gray-800 p-6 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Левая часть: Логотип или название -->
        <div class="text-xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-gray-400">Мафия</a>
        </div>

        <!-- Центральная часть: Кнопки "Рейтинг" и "Дашборд" -->
        <div class="flex-1 text-center space-x-4">
            <a href="{{ route('rating') }}" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700">Рейтинг</a>

            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 rounded hover:bg-green-700">Дашборд</a>
            @endauth
        </div>

        <!-- Правая часть: Вход, Регистрация, Выход -->
        <div class="flex space-x-4">
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 hover:text-gray-400">Вход</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">Регистрация</a>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">
                        Выход
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>