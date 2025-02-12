<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Добавлено -->
    <title>@yield('title', 'Мафия')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col min-h-screen text-gray-900">
    @include('layouts.navigation')

    <div class="flex flex-col flex-grow container mx-auto p-4 sm:p-6 md:p-8">
        @yield('content')
    </div>

    <footer class="text-center p-4 bg-gray-200 mt-auto sm:p-6 md:p-8">
        © 2025 Zen
    </footer>
</body>

</html>