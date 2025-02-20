@extends('layouts.app')
@section('title', 'Роли в игры')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <swiper-container
            slides-per-view="1"
            space-between="20"
            loop="true"
            navigation="true"
            pagination="true"
            pagination-clickable="true"
            pagination-dynamic-bullets="true"
        >
            <!-- Карточка Адвоката -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/advokat.png') }}" alt="Адвокат" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl font-bold mb-4">Адвокат</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мафия<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Адвокат знает мафию, но мафия не знает Адвоката. Просыпается в первую ночь, чтобы познакомиться с ведущим.<br>
                            Мафия обозначает себя поднятием руки и Адвокат выбирает, кого он будет защищать.<br>
                            Если этого игрока выгоняют на голосовании, то ведущий говорит, что это мафия, которая защищена Адвокатом. И этот игрок останется в игре до тех пор,
                            пока не найдут Адвоката. Для проверяющих карт Адвокат является Мирным Жителем.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Карточка Актёра -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/actor.png') }}" alt="Актёр" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl font-bold mb-4">Актёр</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Актёр просыпается в первую ночь, чтобы познакомиться с ведущим. Дальше играет за мирных.<br>
                            В случае гибели любой активноролевой карты, мафии, ведущий предлагает актёру забрать роль погибшего. Снятая маска принимается за согласие.<br>
                            Забрав роль персонажа, играет ей до конца игры.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Карточка Бессмертного -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/bessmertniy.png') }}" alt="Бессмертный" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl font-bold mb-4">Бессмертный</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                            Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Добавьте остальные карточки здесь -->
        </swiper-container>
    </div>
</div>

@endsection