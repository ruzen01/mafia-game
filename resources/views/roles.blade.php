@extends('layouts.app')
@section('title', 'Роли в игре Мафия | Mafia-VDK')
@section('content')

@php
$roles = json_decode(file_get_contents(resource_path('json/roles.json')), true);
@endphp

<blockquote class="text-center mb-8 text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-400">
    Играть роль не сложно. Оставаться собой — вот где искусство.
</blockquote>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($roles as $id => $role)
    <div class="cursor-pointer group" onclick="openCard('{{ $id }}')">
        @php
            // Проверяем, существует ли файл изображения
            $imagePath = $role['image'] ? public_path($role['image']) : null;
            $image = ($imagePath && file_exists($imagePath)) ? asset($role['image']) : asset('images/roles/placeholder.png');
        @endphp
        <div class="relative overflow-hidden rounded-lg border-2 border-gray-300 transition-all duration-300 group-hover:border-blue-400 group-hover:shadow-xl">
            <img src="{{ $image }}" alt="Роль {{ $role['title'] }} в игре Мафия от Mafia-VDK" class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-110">
            <!-- Overlay с названием роли -->
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-end">
                <p class="text-white text-center w-full pb-2 font-semibold text-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ $role['title'] }}
                </p>
            </div>
        </div>
        <p class="text-center mt-2 text-lg font-medium text-gray-800">{{ $role['title'] }}</p>
    </div>
    @endforeach
</div>

<!-- Контейнер для карточки -->
<div id="cardContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center p-4 z-50" style="top: 64px;">
    <div class="bg-white rounded-xl shadow-2xl overflow-hidden max-w-2xl w-full relative my-4">
        <!-- Кнопка закрытия с SVG иконкой -->
        <button onclick="closeCard()" class="absolute top-3 right-3 bg-gray-100 hover:bg-gray-200 rounded-lg w-8 h-8 flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-square-fill text-gray-700" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
            </svg>
        </button>
        <div id="cardContent" class="p-8">
            <!-- Контент карточки будет загружен сюда -->
        </div>
    </div>
</div>

<script>
    // Передача данных из Blade в JavaScript
    const rolesData = @json($roles);

    // Функция для открытия карточки
    function openCard(cardId) {
        const cardContainer = document.getElementById('cardContainer');
        const cardContent = document.getElementById('cardContent');

        const role = rolesData[cardId];

        // Проверяем, существует ли изображение
        const imagePath = role.image ? "{{ asset('') }}" + role.image : null;
        const image = imagePath ? `<img src="${imagePath}" onerror="this.src='{{ asset('images/roles/placeholder.png') }}'" alt="${role.title}" class="w-full h-64 object-cover rounded-lg border border-gray-300 shadow-md">` : `<img src="{{ asset('images/roles/placeholder.png') }}" alt="${role.title}" class="w-full h-64 object-cover rounded-lg border border-gray-300 shadow-md">`;

        // Определяем стили для значения стороны роли
        let sideValueClass;
        switch (role.side) {
            case 'Мафия':
                sideValueClass = 'bg-black text-white px-3 py-1 rounded-full font-semibold'; // Белый текст на черном фоне
                break;
            case 'Мирные':
                sideValueClass = 'bg-green-500 text-white px-3 py-1 rounded-full font-semibold'; // Белый текст на зеленом фоне
                break;
            case 'Сам за себя':
                sideValueClass = 'bg-yellow-500 text-white px-3 py-1 rounded-full font-semibold'; // Белый текст на желтом фоне
                break;
            default:
                sideValueClass = 'bg-gray-100 text-black px-3 py-1 rounded-full font-semibold'; // По умолчанию
        }

        // Проверка: показываем только если не равно 0
        let checkBlock = '';
        if (role.check_result !== 0) {
            let checkValueClass;
            if (role.check_result === 'Мирный житель') {
                checkValueClass = 'bg-gray-100 text-green-600 px-3 py-1 rounded-full font-semibold'; // Зеленый текст на сером фоне
            } else if (role.check_result === 'Мафия') {
                checkValueClass = 'bg-gray-100 text-red-600 px-3 py-1 rounded-full font-semibold'; // Красный текст на сером фоне
            } else {
                checkValueClass = 'bg-gray-100 text-black px-3 py-1 rounded-full font-semibold'; // По умолчанию
            }

            checkBlock = `
                <div class="mt-4">
                    <span class="font-medium text-lg">Проверка:</span>
                    <span class="${checkValueClass}">${role.check_result}</span>
                </div>
            `;
        }

        const content = `
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="w-full md:w-1/2">
                    <img src="${role.image}" alt="${role.title}" class="w-full h-64 object-cover rounded-xl border-2 border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                </div>
                <div class="w-full md:w-1/2 text-left">
                    <h3 class="text-2xl font-extrabold mb-6 text-center md:text-left text-gray-800">${role.title}</h3>
                    <div class="mb-4">
                        <span class="font-medium text-lg">Сторона:</span>
                        <span class="${sideValueClass}">${role.side}</span>
                    </div>
                    ${checkBlock}
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                        <p class="text-base leading-relaxed text-gray-700">
                            ${role.description || 'Описание отсутствует.'}
                        </p>
                    </div>
                </div>
            </div>
        `;

        cardContent.innerHTML = content;
        cardContainer.classList.remove('hidden');
        
        // Добавляем возможность закрытия по нажатию на оверлей
        cardContainer.addEventListener('click', function(e) {
            if (e.target === cardContainer) {
                closeCard();
            }
        });
    }

    // Функция для закрытия карточки
    function closeCard() {
        const cardContainer = document.getElementById('cardContainer');
        cardContainer.classList.add('hidden');
    }

    // Закрытие карточки по нажатию на Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cardContainer = document.getElementById('cardContainer');
            if (!cardContainer.classList.contains('hidden')) {
                closeCard();
            }
        }
    });
</script>

@endsection