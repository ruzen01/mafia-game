@extends('layouts.app')

@section('content')
<div 
    class="container mx-auto py-6" 
    x-data="{
        search: '',
        sortBy: 'name', // 'name', 'rank', 'games'
        get filteredPlayers() {
            let players = @js($players->map(fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'games_count' => $p->games->count(),
                'rank' => $rankMap[$p->id] ?? null,
                'avatar_url' => $p->avatar_url
            ]));

            // Фильтр поиска
            if (this.search) {
                players = players.filter(p => 
                    p.name.toLowerCase().includes(this.search.toLowerCase())
                );
            }

            // Сортировка
            if (this.sortBy === 'rank') {
                players.sort((a, b) => (a.rank || 999) - (b.rank || 999));
            } else if (this.sortBy === 'games') {
                players.sort((a, b) => b.games_count - a.games_count);
            } else {
                players.sort((a, b) => a.name.localeCompare(b.name));
            }

            return players;
        }
    }"
>
    <!-- Уведомления -->
    @if(session('error'))
        <div class="absolute left-0 bg-red-500 text-white p-3 rounded mb-4 animate-fade-in" style="top: 100px; z-index: 10;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="absolute left-0 bg-green-500 text-white p-3 rounded mb-4 animate-fade-in" style="top: 100px; z-index: 10;">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Игроки</h1>

    @can('create', App\Models\Player::class)
    <div class="flex justify-center mb-6">
        <a href="{{ route('players.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition transform hover:scale-105 shadow-md flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
              <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <span>Создать игрока</span>
        </a>
    </div>
    @endcan

    <!-- Панель управления: поиск + сортировка -->
    <div class="max-w-4xl mx-auto mb-8 px-4">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <!-- Поиск -->
            <div class="relative w-full sm:w-64">
                <input 
                    x-model="search"
                    type="text" 
                    placeholder="Поиск по имени..." 
                    class="w-full py-2 pl-10 pr-4 rounded-lg border border-zinc-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search absolute left-3 top-2.5 text-zinc-500" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>

            <!-- Сортировка -->
            <div class="flex flex-wrap gap-2">
                <button 
                    :class="sortBy === 'name' ? 'bg-blue-500 text-white' : 'bg-zinc-200 text-zinc-800'"
                    @click="sortBy = 'name'"
                    class="px-3 py-1.5 rounded-md text-sm font-medium transition hover:bg-blue-600 hover:text-white"
                >
                    По имени
                </button>
                <button 
                    :class="sortBy === 'rank' ? 'bg-blue-500 text-white' : 'bg-zinc-200 text-zinc-800'"
                    @click="sortBy = 'rank'"
                    class="px-3 py-1.5 rounded-md text-sm font-medium transition hover:bg-blue-600 hover:text-white"
                >
                    По месту
                </button>
                <button 
                    :class="sortBy === 'games' ? 'bg-blue-500 text-white' : 'bg-zinc-200 text-zinc-800'"
                    @click="sortBy = 'games'"
                    class="px-3 py-1.5 rounded-md text-sm font-medium transition hover:bg-blue-600 hover:text-white"
                >
                    По играм
                </button>
            </div>
        </div>
    </div>

    <!-- Сетка карточек игроков -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center px-4">
        <template x-for="player in filteredPlayers" :key="player.id">
            <a 
                :href="'{{ route('players.show', ':id') }}'.replace(':id', player.id)"
                class="w-48 h-64 bg-white rounded-xl shadow-lg border-2 border-zinc-300 hover:shadow-xl hover:scale-105 transition-all duration-300 cursor-pointer relative overflow-hidden group block"
            >
                <!-- Область фото -->
                <div class="w-full h-36 flex items-center justify-center overflow-hidden bg-white">
                    <img 
                        :src="player.avatar_url"
                        :alt="player.name"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        @error="this.style.display='none'; $el.nextElementSibling.style.display='flex'"
                    >
                    <div class="w-full h-full flex items-center justify-center text-zinc-400" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                          <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                        </svg>
                    </div>
                </div>

                <!-- Имя и статистика -->
                <div class="p-3 text-center flex flex-col items-center justify-center h-28">
                    <div class="font-semibold text-zinc-800 group-hover:text-blue-600 transition-colors leading-tight" x-text="player.name">
                    </div>
                    <div class="mt-2 text-xs text-zinc-800 font-medium">
                        <template x-if="player.rank">
                            <span>🏅<span x-text="player.rank"></span></span>
                        </template>
                        <span class="mx-1">•</span>
                        <span>Игр: <span x-text="player.games_count"></span></span>
                    </div>
                </div>
            </a>
        </template>

        <!-- Сообщение, если игроки не найдены -->
        <template x-if="filteredPlayers.length === 0">
            <div class="col-span-full text-center py-12 text-zinc-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-search mx-auto mb-4 text-zinc-400" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                <div class="text-lg font-medium">Игроки не найдены</div>
                <div class="text-sm">Попробуйте изменить запрос или сбросить фильтры</div>
            </div>
        </template>
    </div>
</div>

<!-- Анимация появления для карточек -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .animate-fade-in {
        animation: fade-in-up 0.6s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush