<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    @vite('resources/css/app.css') <!-- Подключение Tailwind через Vite -->
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Навигационная панель -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700 py-5 px-3 font-semibold">Home</a>
                    <a href="{{ route('rating') }}" class="text-blue-500 hover:text-blue-700 py-5 px-3 font-semibold">Rating</a>
                    <a href="{{ route('rules') }}" class="text-blue-500 hover:text-blue-700 py-5 px-3 font-semibold">Rules</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Основной контент страницы -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>
</html>