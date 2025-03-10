@extends('layouts.app')
@section('title', 'Роли в игре Мафия | Mafia-VDK')
@section('content')

@php
$roles = json_decode(file_get_contents(resource_path('json/roles.json')), true);
@endphp

<blockquote class="text-center mb-4 text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-400">
  Играть роль не сложно. Оставаться собой — вот где искусство.
</blockquote>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($roles as $id => $role)
    <div class="cursor-pointer" onclick="openCard('{{ $id }}')">
        @php
            // Проверяем, существует ли файл изображения
            $imagePath = $role['image'] ? public_path($role['image']) : null;
            $image = ($imagePath && file_exists($imagePath)) ? asset($role['image']) : asset('images/roles/placeholder.png');
        @endphp
        <img src="{{ $image }}" alt="Роль {{ $role['title'] }} в игре Мафия от Mafia-VDK" class="w-full h-32 object-cover rounded-lg border border-gray-300 transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:sepia">
        <p class="text-center mt-2">{{ $role['title'] }}</p>
    </div>
    @endforeach
</div>

<!-- Контейнер для карточки -->
<div id="cardContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center p-4 overflow-y-auto" style="top: 64px;">
    <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-2xl w-full relative my-4">
        <button onclick="closeCard()" class="absolute top-2 right-2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-300">
            &times;
        </button>
        <div id="cardContent" class="p-6">
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
        const image = imagePath ? `<img src="${imagePath}" onerror="this.src='{{ asset('images/roles/placeholder.png') }}'" alt="${role.title}" class="w-full h-48 object-cover rounded-lg border border-gray-300">` : `<img src="{{ asset('images/roles/placeholder.png') }}" alt="${role.title}" class="w-full h-48 object-cover rounded-lg border border-gray-300">`;

        // Определяем стили для значения стороны роли
        let sideValueClass;
        switch (role.side) {
            case 'Мафия':
                sideValueClass = 'bg-black text-white'; // Белый текст на черном фоне
                break;
            case 'Мирные':
                sideValueClass = 'bg-red-500 text-white'; // Белый текст на красном фоне
                break;
            case 'Сам за себя':
                sideValueClass = 'bg-yellow-500 text-white'; // Белый текст на желтом фоне
                break;
            default:
                sideValueClass = 'bg-gray-100 text-black'; // По умолчанию
        }

        // Проверка: показываем только если не равно 0
        let checkBlock = '';
        if (role.check_result !== 0) {
            let checkValueClass;
            if (role.check_result === 'Мирный житель') {
                checkValueClass = 'bg-gray-100 text-red-500'; // Красный текст на сером фоне
            } else if (role.check_result === 'Мафия') {
                checkValueClass = 'bg-gray-100 text-black'; // Черный текст на сером фоне
            } else {
                checkValueClass = 'bg-gray-100 text-black'; // По умолчанию
            }

            checkBlock = `
                <div class="mt-2">
                    <span class="font-medium">Проверка:</span>
                    <span class="px-2 py-1 rounded ${checkValueClass}">${role.check_result}</span>
                </div>
            `;
        }

        const content = `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto">
                    <img src="${role.image}" alt="${role.title}" class="w-full h-full object-cover rounded-lg border border-gray-300">
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl text-center font-bold mb-4">${role.title}</h3>
                    <div>
                        <span class="font-medium">Сторона:</span>
                        <span class="px-2 py-1 rounded ${sideValueClass}">${role.side}</span>
                    </div>
                    ${checkBlock}
                    <p class="text-sm mt-4">
                        ${role.description || 'Описание отсутствует.'}
                    </p>
                </div>
            </div>
        `;

        cardContent.innerHTML = content;
        cardContainer.classList.remove('hidden');
    }

    // Функция для закрытия карточки
    function closeCard() {
        const cardContainer = document.getElementById('cardContainer');
        cardContainer.classList.add('hidden');
    }
</script>

@endsection