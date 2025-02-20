@extends('layouts.app')
@section('title', 'Роли в игры')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <swiper-container
            effect="cards"
            slides-per-view="1.2"
            centered-slides="true"
            perSlideOffset="8"
            perSlideRotate="0"
            rotate="false"
            slideShadows="true"
            watchSlidesProgress="true"
            class="max-w-full overflow-hidden"
        >
            <!-- Карточка Адвоката -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden h-[600px] md:h-[550px]">
                <div class="p-6 flex flex-col md:flex-row items-center h-full">
                    <div class="w-full md:w-1/2 relative aspect-square">
                        <img src="{{ asset('images/roles/advokat.png') }}" alt="Адвокат" class="absolute inset-0 w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left flex flex-col justify-between">
                        <h3 class="text-xl font-bold mb-4">Адвокат</h3>
                        <div class="flex-1 overflow-y-auto max-h-[200px] md:max-h-[300px] scroll-smooth custom-scrollbar">
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
                </div>
            </swiper-slide>
            <!-- Карточка Актёра -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden h-[600px] md:h-[550px]">
                <div class="p-6 flex flex-col md:flex-row items-center h-full">
                    <div class="w-full md:w-1/2 relative aspect-square">
                        <img src="{{ asset('images/roles/actor.png') }}" alt="Актёр" class="absolute inset-0 w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left flex flex-col justify-between">
                        <h3 class="text-xl font-bold mb-4">Актёр</h3>
                        <div class="flex-1 overflow-y-auto max-h-[200px] md:max-h-[300px] scroll-smooth custom-scrollbar">
                            <p class="text-gray-700 text-sm">
                                Сторона: Мирные<br>
                                Проверка: <span class="text-red-500">Мирный житель</span><br>
                                Актёр просыпается в первую ночь, чтобы познакомиться с ведущим. Дальше играет за мирных.<br>
                                В случае гибели любой активноролевой карты, мафии, ведущий предлагает актёру забрать роль погибшего. Снятая маска принимается за согласие.<br>
                                Забрав роль персонажа, играет ей до конца игры.
                            </p>
                        </div>
                    </div>
                </div>
            </swiper-slide>
            <!-- Карточка Бессмертного -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden h-[600px] md:h-[550px]">
                <div class="p-6 flex flex-col md:flex-row items-center h-full">
                    <div class="w-full md:w-1/2 relative aspect-square">
                        <img src="{{ asset('images/roles/bessmertniy.png') }}" alt="Бессмертный" class="absolute inset-0 w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left flex flex-col justify-between">
                        <h3 class="text-xl font-bold mb-4">Бессмертный</h3>
                        <div class="flex-1 overflow-y-auto max-h-[200px] md:max-h-[300px] scroll-smooth custom-scrollbar">
                            <p class="text-gray-700 text-sm">
                                Сторона: Мирные<br>
                                Проверка: <span class="text-red-500">Мирный житель</span><br>
                                Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                                Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                            </p>
                        </div>
                    </div>
                </div>
            </swiper-slide>
            <!-- Карточка Брокера -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden h-[600px] md:h-[550px]">
                <div class="p-6 flex flex-col md:flex-row items-center h-full">
                    <div class="w-full md:w-1/2 relative aspect-square">
                        <img src="{{ asset('images/roles/broker.png') }}" alt="Брокер" class="absolute inset-0 w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left flex flex-col justify-between">
                        <h3 class="text-xl font-bold mb-4">Брокер</h3>
                        <div class="flex-1 overflow-y-auto max-h-[200px] md:max-h-[300px] scroll-smooth custom-scrollbar">
                            <p class="text-gray-700 text-sm">
                                Сторона: Мирные<br>
                                Проверка: <span class="text-red-500">Мирный житель</span><br>
                                Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                                Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                            </p>
                        </div>
                    </div>
                </div>
            </swiper-slide>
            <!-- Добавьте остальные карточки здесь -->
        </swiper-container>
    </div>
</div>

<style>
    /* Скрытие ползунка прокрутки */
    .custom-scrollbar {
        scrollbar-width: none; /* Firefox */
    }

    .custom-scrollbar::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Edge */
    }
</style>
@endsection