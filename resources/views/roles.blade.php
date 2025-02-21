@extends('layouts.app')
@section('title', 'Роли в игрe')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <swiper-container
            effect="cards"
            slides-per-view="1"
            centered-slides="true"
            perSlideOffset="8"
            perSlideRotate="0"
            rotate="false"
            slideShadows="true"
            mousewheel="true"
            pagination="true"
            class="max-w-full overflow-hidden">
            <!-- Карточка Адвоката -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/advokat.png') }}" alt="Адвокат" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center text-center font-bold mb-4">Адвокат</h3>
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
                        <h3 class="text-xl text-center font-bold mb-4">Актёр</h3>
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
                        <h3 class="text-xl text-center font-bold mb-4">Бессмертный</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                            Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                        </p>
                    </div>
                </div>
            </swiper-slide>


            <!-- Карточка Брокера -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/broker.png') }}" alt="Брокер" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Брокер</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                            Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Карточка Взломщик -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/vzlomshik.png') }}" alt="Взломщик" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Взломщик</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Взломщик своей ролью за игру может воспользоваться один раз. Ведущий ему предлагает проснуться каждую ночь, снятая маска принимается за согласие.
                            Роль игрока, на которого укажет взломщик, будет объявлена ведущим утром. Выполнив свою функцию, Взломщик становится мирным жителем.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 flex flex-col md:flex-row items-center">
        <div class="w-full md:w-1/2 h-70 md:h-auto">
            <img src="{{ asset('images/roles/vor.png') }}" alt="Вор" class="w-full h-full object-cover rounded-lg border border-gray-300">
        </div>
        <div class="w-full md:w-1/2 md:pl-8 text-left">
            <h3 class="text-xl text-center font-bold mb-4">Вор</h3>
            <p class="text-sm">
                Сторона: Мирные<br>
                Проверка: <span class="text-red-500">Мирный житель</span><br>
                Вор своей ролью может воспользоваться, если в него будут стрелять. Тогда его будет ведущи и Вор решает кто уйдёт вместо него, затем засыпает.<br>
                Этого игрока будит ведущий. У этого игрока есть две попытки, чтобы найти Вора. Если выбранный игрок находит Вора, то игрок остаётся, а Вор игру покидает.<br>
                Если Вора не нашли, то игру покидает игрок, выбранный Вором. В Вора могут стрелять каждую ночь и он сам будет решать, кому уходить.
            </p>
        </div>
    </div>
</swiper-slide>

            <!-- Карточка Депутата -->
            <swiper-slide class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/deputat.png') }}" alt="Вор" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Депутат</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Депутат просыпается каждую ночь и даёт иммунитет любому из участников игры. Но об этом знают только Депутат и ведущий.<br>
                            Если игрока, которому депутат дал иммунитет, подняли на голосовании, то ведущий это объявляет. Игрок может сесть, а вместо себя поднять любого из игроков, которые в него голосовали (хоть всех).
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Карточка Диктатор -->
            <swiper-slide class="relative bg-gradient-to-br from-stone-800 to-stone-300 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row items-center text-white">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/diktator.png') }}" alt="Диктатор" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Диктатор</h3>
                        <p class="text-gray-700 text-sm">
                            Сторона: Сам за себя<br>
                            Проверка: <span class="text-red-500">?</span><br>
                            Самое главное отличие этой роли - он никого не убивает ночью. Просыпается каждую ночь, показывает на любого участника игры, которого, по его мнению, точно НЕ выгонят днём.<br>
                            Если Диктатора выгонят днём, то уйдёт тот игрок, на кого он указывал ночью. Каждую ночь выбирается новый игрок. Чтобы городу выгнать Диктатора, надо выгнать того игрока, которого он выбирал ночью.
                        </p>
                    </div>
                </div>
            </swiper-slide>

            <!-- Добавьте остальные карточки здесь -->
        </swiper-container>
    </div>
</div>

@endsection