<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Узнайте о различных ролях в игре Мафия от Mafia-VDK во Владивостоке. Идеально для вечеринок, корпоративов и развлечений!">
    <meta name="keywords" content="игра, мафия, городская мафия, владивосток, mafia, vdk, mafia-vdk, вечеринки, корпоративы, развлечения, игры для компаний">
    <meta name="google-site-verification" content="gmHYW6KKYz4xhymrwahEL3rjEvSoQi0M4ekqvIgUD-s" />

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og:title', 'Мафия')">
    <meta property="og:description" content="@yield('og:description', 'Узнайте о различных ролях в игре Мафия от Mafia-VDK во Владивостоке. Идеально для вечеринок, корпоративов и развлечений!')">
    <meta property="og:image" content="@yield('og:image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Schema.org -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "headline": "@yield('og:title', 'Мафия')",
      "description": "@yield('og:description', 'Узнайте о различных ролях в игре Мафия от Mafia-VDK во Владивостоке. Идеально для вечеринок, корпоративов и развлечений!')",
      "image": "@yield('og:image', asset('images/logo.png'))",
      "url": "{{ url()->current() }}",
      "datePublished": "@yield('datePublished', now()->toIso8601String())",
      "author": {
        "@type": "Organization",
        "name": "Mafia-VDK"
      }
    }
    </script>

    <title>@yield('title', 'MAFIA-VDK')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-100 flex flex-col min-h-screen text-zinc-900">
    @include('layouts.navigation')

    <!-- Основной контент (БЕЗ лишнего ограничения max-w-4xl) -->
    <div class="flex flex-col flex-grow container mx-auto p-4 sm:p-6">
        @yield('content') <!-- Теперь контент использует всю ширину контейнера -->
    </div>

    <!-- Компактный футер -->
    <footer class="w-full text-center text-white py-1 px-4 sm:px-6 bg-zinc-800 mt-auto">
        mafia-vdk © 2025
    </footer>
</body>

</html>