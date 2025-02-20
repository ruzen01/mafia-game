<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Добавлено -->
    <title>@yield('title', 'Мафия')</title>

    <!-- Добавляем favicon -->
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen text-gray-900">
    @include('layouts.navigation')

    <div class="flex flex-col flex-grow container mx-auto p-4 sm:p-6 md:p-8">
        @yield('content')
    </div>

    <footer class="w-full text-center p-4 bg-gray-200 mt-auto sm:p-6 md:p-8">
    © 2025 Mafia-vdk
    </footer>
</body>

</html>