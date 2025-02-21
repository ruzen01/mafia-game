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

        <!-- Добавьте остальные миниатюры здесь -->
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
        // Добавьте остальные карточки здесь
    };

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