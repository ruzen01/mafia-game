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
        <div class="mt-2 text-center flex items-center justify-center">
            <!-- Иконка слева от названия -->
            <span class="inline-block mr-1.5">
                @if($role['side'] === 'Мафия')
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-incognito inline-block text-black" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205a1.032 1.032 0 0 0-.014-.058l-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5c-.62 0-1.411-.136-2.025-.267-.541-.115-1.093.2-1.239.735Zm.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a29.58 29.58 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274ZM3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Zm-1.5.5c0-.175.03-.344.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085c.055.156.085.325.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0v-1Zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                @elseif($role['side'] === 'Мирные')
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-heart inline-block text-red-500" viewBox="0 0 16 16">
                      <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                    </svg>
                @elseif($role['side'] === 'Сам за себя')
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-3-square inline-block text-orange-500" viewBox="0 0 16 16">
                      <path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318Z"/>
                      <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2Zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2Z"/>
                    </svg>
                @endif
            </span>
            <!-- Название роли — просто текст, по центру -->
            <span class="font-medium text-gray-800">{{ $role['title'] }}</span>
        </div>
    </div>
    @endforeach
</div>

<!-- Модальное окно роли -->
<div 
    id="cardContainer" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center p-4 overflow-y-auto hidden opacity-0 transition-opacity duration-300"
    style="top: 64px;"
    onclick="closeCard()"
>
    <div 
        class="bg-white rounded-lg shadow-xl max-w-2xl w-full my-4 transform scale-95 transition-transform duration-300"
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

        // Изображение — без обрезания, сохраняет пропорции
        const imagePath = role.image ? "{{ asset('') }}" + role.image : null;
        const image = imagePath 
            ? `<img src="${imagePath}" onerror="this.src='{{ asset('images/roles/placeholder.png') }}'" alt="${role.title}" class="w-full max-h-80 object-contain rounded-lg border border-gray-300 mx-auto">`
            : `<img src="{{ asset('images/roles/placeholder.png') }}" alt="${role.title}" class="w-full max-h-80 object-contain rounded-lg border border-gray-300 mx-auto">`;

        // Стиль стороны: фон + белый текст (для бейджа в модалке)
        let sideValueClass;
        switch (role.side) {
            case 'Мафия':
                sideValueClass = 'bg-zinc-700 text-white';
                break;
            case 'Мирные':
                sideValueClass = 'bg-red-700 text-white';
                break;
            case 'Сам за себя':
                sideValueClass = 'bg-orange-700 text-white';
                break;
            default:
                sideValueClass = 'bg-gray-600 text-white';
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

        // Формируем контент — НАЗВАНИЕ РОЛИ БЕЗ ФОНА, ПРОСТО ТЕКСТ
        const content = `
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 mb-4 md:mb-0 flex justify-center">
                    ${image}
                </div>
                <div class="w-full md:w-1/2 md:pl-8 text-left">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">
                        ${role.title}
                    </h3>
                    <div class="mt-3">
                        <span class="font-medium">Сторона:</span>
                        <span class="px-3 py-1 rounded ${sideValueClass}">${role.side}</span>
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

    function closeCard() {
        const cardContainer = document.getElementById('cardContainer');
        cardContainer.classList.remove('show');
        setTimeout(() => cardContainer.classList.add('hidden'), 300);
    }
</script>

@endsection