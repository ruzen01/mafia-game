@extends('layouts.app')
@section('title', 'Роли в игре')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Сетка миниатюр -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Миниатюра Адвоката -->
        <div class="cursor-pointer" onclick="openCard('advokat')">
            <img src="{{ asset('images/roles/advokat.webp') }}" alt="Адвокат" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Адвокат</p>
        </div>

        <!-- Миниатюра Актёра -->
        <div class="cursor-pointer" onclick="openCard('actor')">
            <img src="{{ asset('images/roles/actor.webp') }}" alt="Актёр" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Актёр</p>
        </div>

        <!-- Миниатюра Бессмертного -->
        <div class="cursor-pointer" onclick="openCard('bessmertniy')">
            <img src="{{ asset('images/roles/bessmertniy.webp') }}" alt="Бессмертный" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Бессмертный</p>
        </div>


        <!-- Миниатюра Брокера -->
        <div class="cursor-pointer" onclick="openCard('broker')">
            <img src="{{ asset('images/roles/broker.webp') }}" alt="Брокер" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Брокер</p>
        </div>


        <!-- Миниатюра Взломщика -->
        <div class="cursor-pointer" onclick="openCard('vzlomshik')">
            <img src="{{ asset('images/roles/vzlomshik.webp') }}" alt="Взломщик" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Взломщик</p>
        </div>

        <!-- Миниатюра Вора -->
        <div class="cursor-pointer" onclick="openCard('vor')">
            <img src="{{ asset('images/roles/vor.webp') }}" alt="Вор" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Вор</p>
        </div>

        <!-- Миниатюра Депутата -->
        <div class="cursor-pointer" onclick="openCard('deputat')">
            <img src="{{ asset('images/roles/deputat.webp') }}" alt="Депутат" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Депутат</p>
        </div>

        <!-- Миниатюра Диктатор -->
        <div class="cursor-pointer" onclick="openCard('diktator')">
            <img src="{{ asset('images/roles/diktator.webp') }}" alt="Диктатор" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Диктатор</p>
        </div>

        <!-- Миниатюра Доктора -->
        <div class="cursor-pointer" onclick="openCard('doctor')">
            <img src="{{ asset('images/roles/doctor.webp') }}" alt="Доктор" class="w-full h-32 object-cover rounded-lg border border-gray-300">
            <p class="text-center mt-2">Доктор</p>
        </div>
    </div>

    <!-- Карточки с подробной информацией -->
    <div id="cardContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-2xl w-full relative">
            <button onclick="closeCard()" class="absolute top-2 right-2 bg-gray-200 rounded-full p-2 hover:bg-gray-300">
                &times;
            </button>
            <div id="cardContent" class="p-6">
                <!-- Контент карточки будет загружен сюда -->
            </div>
        </div>
    </div>
</div>

<script>
    // Данные для карточек
    const cardsData = {
        advokat: {
            title: 'Адвокат',
            image: "{{ asset('images/roles/advokat.webp') }}",
            content: `
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/advokat.webp') }}" alt="Адвокат" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Адвокат</h3>
                        <p class="text-sm">
                            Сторона: <span class="bg-black text-white px-1 rounded">Мафия</span><br>
                            Проверка: <span class="bg-gray-100 text-red-500 px-1 rounded">Мирный житель</span><br>
                            Адвокат знает мафию, но мафия не знает Адвоката. Просыпается в первую ночь, чтобы познакомиться с ведущим.<br>
                            Мафия обозначает себя поднятием руки и Адвокат выбирает, кого он будет защищать.<br>
                            Если этого игрока выгоняют на голосовании, то ведущий говорит, что это мафия, которая защищена Адвокатом. И этот игрок останется в игре до тех пор,
                            пока не найдут Адвоката. Для проверяющих карт Адвокат является Мирным Жителем.
                        </p>
                    </div>
                </div>
            `
        },
        actor: {
            title: 'Актёр',
            image: "{{ asset('images/roles/actor.webp') }}",
            content: `
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/actor.webp') }}" alt="Актёр" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Актёр</h3>
                        <p class="text-sm">
                            Сторона: <span class="bg-red-500 text-white px-1 rounded">Мирные</span><br>
                            Проверка: <span class="bg-gray-100 text-red-500 px-1 rounded">Мирный житель</span><br>
                            Актёр просыпается в первую ночь, чтобы познакомиться с ведущим. Дальше играет за мирных.<br>
                            В случае гибели любой активноролевой карты, мафии, ведущий предлагает актёру забрать роль погибшего. Снятая маска принимается за согласие.<br>
                            Забрав роль персонажа, играет ей до конца игры.
                        </p>
                    </div>
                </div>
            `
        },
        bessmertniy: {
            title: 'Бессмертный',
            image: "{{ asset('images/roles/bessmertniy.webp') }}",
            content: `
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/bessmertniy.webp') }}" alt="Бессмертный" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Бессмертный</h3>
                        <p class="text-sm">
                            Сторона: Мирные<br>
                            Проверка: <span class="text-red-500">Мирный житель</span><br>
                            Бессмертный просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных.<br>
                            Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                        </p>
                    </div>
                </div>
            `
        },
        broker: {
            title: 'Брокер',
            image: "{{ asset('images/roles/broker.webp') }}",
            content: `
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2 h-70 md:h-auto">
                        <img src="{{ asset('images/roles/broker.webp') }}" alt="Брокер" class="w-full h-full object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 text-left">
                        <h3 class="text-xl text-center font-bold mb-4">Брокер</h3>
                        <p class="text-sm">
                            Брокер  просыпается в первую ночь, чтобы познакомиться с ведущим. Дальше играет, как обычный мирный. Если в него ночью будут стрелять, он проснётся и сделает выстрел сам. Если в него будут стрелять второй раз, он погибнет. Если Брокера выгонять на дневном голосовании, с ним уйдёт тот, кто первый в него проголосовал (на первом голосовании).
                            </p>
                    </div>
                </div>
            `
        },
        vzlomshik: {
            title: 'Взломщик',
            image: "{{ asset('images/roles/vzlomshik.webp') }}",
            content: `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="{{ asset('images/roles/vzlomshik.webp') }}" alt="Взломщик" class="w-full h-full object-cover rounded-lg border border-gray-300">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl text-center font-bold mb-4">Взломщик</h3>
                    <p class="text-sm">
                        Сторона: Мирные<br>
                        Проверка: <span class="text-red-500">Мирный житель</span><br>
                        Взломщик своей ролью за игру может воспользоваться один раз. Ведущий ему предлагает проснуться каждую ночь, снятая маска принимается за согласие.
                        Роль игрока, на которого укажет взломщик, будет объявлена ведущим утром. Выполнив свою функцию, Взломщик становится мирным жителем.
                    </p>
                </div>
            </div>
        `
        },
        vor: {
            title: 'Вор',
            image: "{{ asset('images/roles/vor.webp') }}",
            content: `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="{{ asset('images/roles/vor.webp') }}" alt="Вор" class="w-full h-full object-cover rounded-lg border border-gray-300">
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
        `
        },
        deputat: {
            title: 'Депутат',
            image: "{{ asset('images/roles/deputat.webp') }}",
            content: `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="{{ asset('images/roles/deputat.webp') }}" alt="Депутат" class="w-full h-full object-cover rounded-lg border border-gray-300">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl text-center font-bold mb-4">Депутат</h3>
                    <p class="text-sm">
                        Сторона: Мирные<br>
                        Проверка: <span class="text-red-500">Мирный житель</span><br>
                        Депутат просыпается каждую ночь и даёт иммунитет любому из участников игры. Но об этом знают только Депутат и ведущий.<br>
                        Если игрока, которому депутат дал иммунитет, подняли на голосовании, то ведущий это объявляет. Игрок может сесть, а вместо себя поднять любого из игроков, которые в него голосовали (хоть всех).
                    </p>
                </div>
            </div>
        `
        },
        diktator: {
            title: 'Диктатор',
            image: "{{ asset('images/roles/diktator.webp') }}",
            content: `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="{{ asset('images/roles/diktator.webp') }}" alt="Диктатор" class="w-full h-full object-cover rounded-lg border border-gray-300">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl text-center font-bold mb-4">Диктатор</h3>
                    <p class="text-sm">
                        Сторона: Сам за себя<br>
                        Проверка: <span class="text-red-500">?</span><br>
                        Самое главное отличие этой роли - он никого не убивает ночью. Просыпается каждую ночь, показывает на любого участника игры, которого, по его мнению, точно НЕ выгонят днём.<br>
                        Если Диктатора выгонят днём, то уйдёт тот игрок, на кого он указывал ночью. Каждую ночь выбирается новый игрок. Чтобы городу выгнать Диктатора, надо выгнать того игрока, которого он выбирал ночью.
                    </p>
                </div>
            </div>
        `
        },
        doctor: {
            title: 'Доктор',
            image: "{{ asset('images/roles/doctor.webp') }}",
            content: `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="{{ asset('images/roles/doctor.webp') }}" alt="Доктор" class="w-full h-full object-cover rounded-lg border border-gray-300">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl text-center font-bold mb-4">Доктор</h3>
                    <p class="text-sm">
                        Сторона: <span class="bg-red-500 text-white px-1 rounded">Мирные</span><br>
                        Проверка: <span class="bg-gray-100 text-red-500 px-1 rounded">Мирный житель</span><br>
                        Просыпается каждую ночь и лечит игрока, в которого, по его мнению, стреляла мафия. Себя за игру доктор может лечить три раза (в том числе и подряд).<br>
                        Всех остальных участников может лечить неограниченное количество раз, но не две ночи подряд.
                    </p>
                </div>
            </div>
        `
        }
    };

    // Добавьте остальные карточки здесь


    // Функция для открытия карточки
    function openCard(cardId) {
        const cardContainer = document.getElementById('cardContainer');
        const cardContent = document.getElementById('cardContent');
        cardContent.innerHTML = cardsData[cardId].content;
        cardContainer.classList.remove('hidden');
    }

    // Функция для закрытия карточки
    function closeCard() {
        const cardContainer = document.getElementById('cardContainer');
        cardContainer.classList.add('hidden');
    }
</script>

@endsection