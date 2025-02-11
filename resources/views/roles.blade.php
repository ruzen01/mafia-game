@extends('layouts.app')
@section('title', 'Роли в игре')
@section('content')
<!-- Подключение Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<!-- Подключение Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<div class="container mx-auto px-4 py-8">
    <!-- Заголовок -->
    <h1 class="text-3xl font-bold mb-8 text-center">Роли в игре Мафия</h1>
    <!-- Карусель -->
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Карточка Адвоката -->
                <div class="swiper-slide relative flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden w-72">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Адвокат</h3>
                        <p class="text-gray-700 text-sm">
                            Адвокат (играет за мафию) - Знает мафию, мафия не знает Адвоката. Просыпается в первую ночь, чтобы познакомиться с ведущим. Мафия обозначает себя поднятием руки, и Адвокат выбирает, кого он будет защищать.
                        </p>
                    </div>
                </div>
                <!-- Карточка Мафии -->
                <div class="swiper-slide relative flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden w-72">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Мафия</h3>
                        <p class="text-gray-700 text-sm">
                            Мафия убивает одного игрока каждую ночь.
                        </p>
                    </div>
                </div>
                <!-- Карточка Доктора -->
                <div class="swiper-slide relative flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden w-72">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Доктор</h3>
                        <p class="text-gray-700 text-sm">
                            Доктор может спасти одного игрока каждую ночь.
                        </p>
                    </div>
                </div>
                <!-- Карточка Шерифа -->
                <div class="swiper-slide relative flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden w-72">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Шериф</h3>
                        <p class="text-gray-700 text-sm">
                            Шериф может проверить роль одного игрока каждую ночь.
                        </p>
                    </div>
                </div>
                <!-- Карточка Маньяка -->
                <div class="swiper-slide relative flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden w-72">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Маньяк</h3>
                        <p class="text-gray-700 text-sm">
                            Маньяк убивает самостоятельно, не координируясь с другими.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Навигация -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Пагинация -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- Скрипт для Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 1,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
</div>
@endsection