@extends('layouts.app')
@section('title', 'Роли в игре Мафия | Mafia-VDK')
@section('content')

@php
$roles = json_decode(file_get_contents(resource_path('json/roles.json')), true);
@endphp

<blockquote class="text-center mb-8 text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-400">
  Играть роль не сложно. Оставаться собой — вот где искусство.
</blockquote>

<!-- Сетка ролей с анимацией -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($roles as $id => $role)
    <div 
        class="cursor-pointer animate-fade-in opacity-0"
        style="animation-delay: {{ $loop->index * 0.1 }}s"
        onclick="openCard('{{ $id }}')"
    >
        @php
            $imagePath = $role['image'] ? public_path($role['image']) : null;
            $image = ($imagePath && file_exists($imagePath)) ? asset($role['image']) : asset('images/roles/placeholder.png');
        @endphp
        <img 
            src="{{ $image }}" 
            alt="Роль {{ $role['title'] }} в игре Мафия от Mafia-VDK" 
            class="w-full h-32 object-cover rounded-lg border border-gray-300 transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:sepia"
        >
        <p class="text-center mt-2 font-medium 
            @if($role['side'] === 'Мафия') text-black
            @elseif($role['side'] === 'Мирные') text-red-500
            @elseif($role['side'] === 'Сам за себя') text-orange-500
            @else text-gray-700 @endif">
            {{ $role['title'] }}
        </p>
    </div>
    @endforeach
</div>

<!-- Модальное окно роли -->
<div 
    id="cardContainer" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center p-4 overflow-y-auto hidden opacity-0 transition-opacity duration-300"
    style="top: 64px;"
    onclick="closeCard(event)"
>
    <div 
        class="bg-white rounded-lg shadow-xl max-w-2xl w-full my-4 transform scale-95 transition-transform duration-300"
        onclick="event.stopPropagation()" <!-- Блокируем всплытие клика -->
    >
        <div id="cardContent" class="p-6">
            <!-- Контент будет вставлен сюда -->
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }

    /* Анимация модального окна */
    #cardContainer.show {
        opacity: 1;
    }
    #cardContainer.show > div {
        transform: scale(1);
    }
</style>

<script>
    const rolesData = @json($roles);

    function openCard(cardId) {
        const cardContainer = document.getElementById('cardContainer');
        const cardContent = document.getElementById('cardContent');
        const role = rolesData[cardId];

        // Изображение
        const imagePath = role.image ? "{{ asset('') }}" + role.image : null;
        const image = imagePath 
            ? `<img src="${imagePath}" onerror="this.src='{{ asset('images/roles/placeholder.png') }}'" alt="${role.title}" class="w-full h-48 object-cover rounded-lg border border-gray-300">`
            : `<img src="{{ asset('images/roles/placeholder.png') }}" alt="${role.title}" class="w-full h-48 object-cover rounded-lg border border-gray-300">`;

        // Стиль стороны
        let sideValueClass;
        switch (role.side) {
            case 'Мафия':
                sideValueClass = 'bg-black text-white';
                break;
            case 'Мирные':
                sideValueClass = 'bg-red-500 text-white';
                break;
            case 'Сам за себя':
                sideValueClass = 'bg-yellow-500 text-white';
                break;
            default:
                sideValueClass = 'bg-gray-100 text-black';
        }

        // Блок проверки (если не 0)
        let checkBlock = '';
        if (role.check_result !== 0) {
            let checkValueClass;
            if (role.check_result === 'Мирный житель') {
                checkValueClass = 'bg-gray-100 text-red-500';
            } else if (role.check_result === 'Мафия') {
                checkValueClass = 'bg-gray-100 text-black';
            } else {
                checkValueClass = 'bg-gray-100 text-black';
            }

            checkBlock = `
                <div class="mt-2">
                    <span class="font-medium">Проверка:</span>
                    <span class="px-2 py-1 rounded ${checkValueClass}">${role.check_result}</span>
                </div>
            `;
        }

        // Формируем контент
        const content = `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 h-70 md:h-auto mb-4 md:mb-0">
                    ${image}
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
        setTimeout(() => cardContainer.classList.add('show'), 10); // Запуск анимации
    }

    function closeCard(event) {
        const cardContainer = document.getElementById('cardContainer');
        if (event.target === cardContainer) {
            cardContainer.classList.remove('show');
            setTimeout(() => cardContainer.classList.add('hidden'), 300);
        }
    }
</script>

@endsection