@extends('layouts.app')
@section('title', 'Роли в игре')
@section('content')

<!-- Подключение Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css" />
<!-- Подключение Swiper JS -->
<script type="module">
  import Swiper from 'https://unpkg.com/swiper@9/swiper-bundle.esm.browser.min.js';
</script>

<div class="container mx-auto px-4 py-8">
    <!-- Карусель -->
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <swiper-container
            slides-per-view="1"
            space-between="20"
            loop="true"
            pagination="true"
            pagination-clickable="true"
            pagination-dynamic-bullets="true"
            navigation="true"
            class="mySwiper"
        >
            <!-- Карточка Адвоката -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <!-- Картинка -->
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/advokat.png') }}" alt="Адвокат" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <!-- Текст -->
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl font-bold mb-4">Адвокат</h3>
                        <p class="text-gray-700 text-sm">
                            <!-- Сторона -->
                            <span class="block">
                                <strong class="font-bold">Сторона:</strong> Мафия
                            </span>
                            <!-- Проверка -->
                            <span class="block">
                                <strong class="font-bold">Проверка:</strong> <span class="text-red-500">Мирный житель</span>
                            </span>
                            <!-- Описание роли -->
                            <strong class="block font-bold mt-4">Описание роли:</strong>
                            <span class="block">
                                Адвокат знает мафию, но мафия не знает Адвоката. Просыпается в первую ночь, чтобы познакомиться с ведущим.<br>
                                Мафия обозначает себя поднятием руки и Адвокат выбирает, кого он будет защищать.<br>
                                Если этого игрока выгоняют на голосовании, то ведущий говорит, что это мафия, которая защищена Адвокатом. И этот игрок останется в игре до тех пор,
                                пока не найдут Адвоката. Для проверяющих карт Адвокат является Мирным Жителем.
                            </span>
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Карточка Актёра -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <!-- Картинка -->
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/actor.png') }}" alt="Актёр" class="w-full h-full object-cover rounded-lg shadow-sm border border-gray-300">
                    </div>
                    <!-- Текст -->
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl font-bold mb-4">Актёр</h3>
                        <p class="text-gray-700 text-sm">
                            <strong>Сторона:</strong> Мирные<br>
                            <strong>Описание роли:</strong><br>
                            Актёр (играет за мирных) - Просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных. В случае гибели любой активноролевой карты, мафии, ведущий предлагает актёру забрать роль погибшего. Снятая маска принимается за согласие. Забрав роль персонажа, играет ей до конца игры.
                        </p>
                    </div>
                </div>
            </swiper-slide>
        </swiper-container>
    </div>
</div>




    @endsection