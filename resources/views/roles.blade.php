@extends('layouts.app')
@section('title', 'Роли в игре')
@section('content')
<!-- Подключение Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<!-- Подключение Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<div class="container mx-auto px-4 py-8">

    <!-- Карусель -->
    <div class="relative max-w-6xl mx-auto">
        <!-- Контейнер для Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Карточка Адвоката -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <img src="{{ asset('images/roles/advokat.png') }}" alt="Адвокат" class="w-full h-70 object-cover mb-3 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 text-center">Адвокат</h3>
                        <p class="text-gray-700 text-sm grid grid-cols-12 gap-2">
                            <strong class="col-span-2">Сторона:</strong>
                            <span class="col-span-10">Мафия</span>

                            <strong class="col-span-2">Проверка:</strong>
                            <span class="col-span-10 text-red-500">Мирный житель</span>

                            <strong class="col-span-2">Описание роли:</strong>
                            <span class="col-span-10">
                                Адвокат знает мафию, но мафия не знает Адвоката. Просыпается в первую ночь, чтобы познакомиться с ведущим.<br>
                                Мафия обозначает себя поднятием руки, и Адвокат выбирает, кого он будет защищать.<br>
                                Если этого игрока выгоняют на голосовании, то ведущий говорит, что это мафия, которая защищена Адвокатом. И этот игрок останется в игре до тех пор,
                                пока не найдут Адвоката. Для проверяющих карт Адвокат является Мирным Жителем.
                            </span>
                        </p>
                    </div>
                </div>
                <!-- Карточка Актёра -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                    <img src="{{ asset('images/roles/actor.png') }}" alt="Актер" class="w-full h-70 object-cover mb-3 rounded-lg">

                        <h3 class="text-xl font-bold mb-4 text-center">Актёр</h3>
                        <p class="text-gray-700 text-sm">
                            Актёр (играет за мирных) - Просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных. В случае гибели любой активноролевой карты, мафии, ведущий предлагает актёру забрать роль погибшего. Снятая маска принимается за согласие. Забрав роль персонажа, играет ей до конца игры.
                        </p>
                    </div>
                </div>
                <!-- Карточка Бессмертного -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                    <img src="{{ asset('images/roles/bessmertniy.png') }}" alt="Бессмертный" class="w-full h-70 object-cover mb-3 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 text-center">Бессмертный</h3>
                        <p class="text-gray-700 text-sm">
                            Бессмертный (играет за мирных) - Просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных. Если в него будут стрелять ночью, то на утро ведущий скажет, что никто не погиб. Его нельзя убить ночью, можно выгнать только на дневном голосовании.
                        </p>
                    </div>
                </div>
                <!-- Карточка Брокера -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                    <img src="{{ asset('images/roles/broker.png') }}" alt="Брокер" class="w-full h-70 object-cover mb-3 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 text-center">Брокер</h3>
                        <p class="text-gray-700 text-sm">
                            Брокер (играет за мирных) - Просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет как обычный Мирный Житель. Если в него ночью будут стрелять, он проснётся и сделает выстрел сам. Если в него будут стрелять второй раз, он погибнет. Если Брокера выгонят на дневном голосовании, с ним уйдёт тот, кто первый в него проголосовал (на первом голосовании).
                        </p>
                    </div>
                </div>
                <!-- Карточка Взломщика -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                    <img src="{{ asset('images/roles/vzlomshik.png') }}" alt="Взломщик" class="w-full h-70 object-cover mb-3 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 text-center">Взломщик</h3>
                        <p class="text-gray-700 text-sm">
                            Взломщик (играет за мирных) - Своей ролью за игру может воспользоваться один раз. Ведущий предлагает ему проснуться каждую ночь, снятая маска принимается за согласие. Человек, на которого укажет Взломщик, на утро ведущий озвучивает его роль. Выполнив свою функцию, Взломщик становится мирным жителем.
                        </p>
                    </div>
                </div>
                <!-- Карточка Вора -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Вор</h3>
                        <p class="text-gray-700 text-sm">
                            Вор (играет за мирных) – Своей ролью может воспользоваться, если в него будут стрелять. Тогда Вор просыпается и решает, кто уйдёт вместо него, затем засыпает. Этого игрока будит ведущий. У него есть две попытки, чтобы найти Вора. Если выбранный игрок находит Вора, то игрок остаётся, а Вор игру покидает. Если Вора не нашли, то покидает игрок, выбранный Вором. Формально, в Вора могут стрелять каждую ночь, и он сам будет решать, кому уходить.
                        </p>
                    </div>
                </div>
                <!-- Карточка Депутата -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Депутат</h3>
                        <p class="text-gray-700 text-sm">
                            Депутат (играет за мирных) – Просыпается каждую ночь и даёт иммунитет любому из участников игры. Но об этом знают только Депутат и ведущий. В случае, если игрока, которому Депутат дал иммунитет, подняли на голосовании, ведущий ему об этом говорит, игрок может сесть, а вместо себя поднять любого из игроков, которые в него голосовали (хоть всех).
                        </p>
                    </div>
                </div>
                <!-- Карточка Диктатора -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Диктатор</h3>
                        <p class="text-gray-700 text-sm">
                            Диктатор (играет сам за себя) - Самое главное отличие этой роли, он никого не убивает ночью. Просыпается каждую ночь, показывает на любого из участников игры, кого, по его мнению, точно не выгонят днём. Если Диктатора выгонят днём, то уйдёт тот игрок, на кого он указывал ночью. Каждую ночь выбирается новый игрок. Чтобы городу выгнать Диктатора, надо выгнать того игрока, которого он выбирал ночью.
                        </p>
                    </div>
                </div>
                <!-- Карточка Доктора -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Доктор</h3>
                        <p class="text-gray-700 text-sm">
                            Доктор (играет за мирных) - Просыпается каждую ночь и ищет, в кого, по его мнению, стреляла мафия. Себя за игру доктор может лечить три раза, в том числе и подряд. Всех остальных участников неограниченное количество раз, но через одну ночь.
                        </p>
                    </div>
                </div>
                <!-- Карточка Дона -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Дон</h3>
                        <p class="text-gray-700 text-sm">
                            Дон мафии - Решение об убийстве принимается от Дона. На кого указывает Дон, тот игрок покидает игру. Дон может принимать подсказки от своей мафии в виде жестикуляции, но последнее слово всегда за Доном.
                        </p>
                    </div>
                </div>
                <!-- Карточка Киллера -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Киллер</h3>
                        <p class="text-gray-700 text-sm">
                            Киллер (играет за мафию) - Не знает мафию, знаком только с Доном. Принимает заказ от Дона на убийство активноролевой карты. В случае выполнения заказа, если Дон будет жив, получит новый, если Дон вышел из игры, познакомится со своей мафией и будет вместе с ними принимать решение об убийстве. Для проверяющих карт, Киллер является Мирным Жителем.
                        </p>
                    </div>
                </div>
                <!-- Карточка Клерка -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Клерк</h3>
                        <p class="text-gray-700 text-sm">
                            Офисный Клерк (играет за мирных) - Первый, кто проголосует в Офисного Клерка, покидает игру после окончания дневного голосования, без права последнего слова. Клерка нельзя выгнать, можно убить только ночью.
                        </p>
                    </div>
                </div>
                <!-- Карточка Клоуна -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Клоун</h3>
                        <p class="text-gray-700 text-sm">
                            Клоун (играет сам за себя) - Просыпается каждую ночь, показывает на любого из участников игры и засыпает. Ведущий будит этого игрока, и уже он совершает убийство. Главная задача Клоуна - не разбудить того, кто выстрелит в него в ответ. Дважды на одного и того же участника показывать нельзя. Когда в игре остаётся 12 человек и меньше, убивает сам. Побеждает в том случае, если останется один на один с любым из участников игры.
                        </p>
                    </div>
                </div>
                <!-- Карточка Комиссара -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Комиссар</h3>
                        <p class="text-gray-700 text-sm">
                            Комиссар (играет за мирных) - Просыпается каждую ночь и ищет мафию. Кивком головы и жестом пальцев ведущий показывает, мафия этот человек или нет. Роли, играющие сами за себя и дополнительные роли, играющие за мафию, для Комиссара проверяются как Мирный Житель.
                        </p>
                    </div>
                </div>
                <!-- Карточка Купидона -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Купидон</h3>
                        <p class="text-gray-700 text-sm">
                            Купидон (создаёт свою коалицию и с ней играет за себя) - Просыпается в первую ночь, выбирает себе двух участников игры и забирает к себе в коалицию. Если игроки, на которых указал Купидон, были какой-либо ролью, то они теряют свои способности и играют за Купидона. Просыпаются ночью и убивают мафию и мирных жителей.
                        </p>
                    </div>
                </div>
                <!-- Карточка Лузера -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                    <img src="{{ asset('images/roles/looser.png') }}" alt="Лузер" class="w-full h-70 object-cover mb-3 rounded-lg">
                        <h3 class="text-xl font-bold mb-4 text-center">Лузер</h3>
                        <p class="text-gray-700 text-sm">
                            Лузер (играет за мирных) - Просыпается в первую ночь, чтобы познакомиться с ведущим, дальше играет за мирных. Если к Лузеру пойдёт проверяющая карта, ведущий скажет, что он мафия. Если в него будут стрелять и лечить, он всё равно погибнет.
                        </p>
                    </div>
                </div>
                <!-- Карточка Маньяка -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Маньяк</h3>
                        <p class="text-gray-700 text-sm">
                            Маньяк (играет сам за себя) - Просыпается каждую ночь и показывает на 3-ёх участников игры и засыпает. Ведущий будит этих игроков, и 2-ое должны выгнать 3-го. Если игроки не определились, тогда они засыпают, просыпается Маньяк и сам решает, кто уйдёт. На любого игрока, в том числе и себя, может показывать через одну ночь. Когда в игре остаётся 12 человек и меньше, убивает сам. Побеждает в том случае, если остаётся один на один с любым из участников игры.
                        </p>
                    </div>
                </div>
                <!-- Карточка Марва -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Марв</h3>
                        <p class="text-gray-700 text-sm">
                            Марв (играет за мирных) – Просыпается каждую ночь и ищет мафию. Если Марв находит чёрного игрока, то может сделать выстрел в любого другого игрока, кроме того, которого уже нашёл.
                        </p>
                    </div>
                </div>
                <!-- Карточка Математика -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Математик</h3>
                        <p class="text-gray-700 text-sm">
                            Математик (играет за мирных) - Просыпается каждую ночь, показывает на любого из участников игры и засыпает. Днём этот человек встанет на оправдание, даже если в него никто не голосовал. На любого игрока, в том числе и себя, Математик может показывать через ночь.
                        </p>
                    </div>
                </div>
                <!-- Карточка Мафии -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Мафия</h3>
                        <p class="text-gray-700 text-sm">
                            Мафия - Просыпается вместе с Доном и смотрит, кого он будет убивать. Может подсказывать Дону при помощи жестикуляции. Если Дон покидает игру, тогда принимается решение большинства.
                        </p>
                    </div>
                </div>
                <!-- Карточка Мирного -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Мирный</h3>
                        <p class="text-gray-700 text-sm">
                            Задача мирных жителей - объединяться, искать и выгонять мафию.
                        </p>
                    </div>
                </div>

                <!-- Карточка Маньяка -->
                <div class="swiper-slide relative bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-center">Маньяк</h3>
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


<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true, // Динамические буллеты
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
</div>
@endsection