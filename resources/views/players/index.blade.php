<!-- Сетка карточек игроков -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center">
    @php
        $playersSorted = $players->sortBy('name');
    @endphp

    @foreach($playersSorted as $index => $player)
    <div 
        class="w-48 h-64 bg-white rounded-xl shadow-lg border-2 border-zinc-300 hover:shadow-xl hover:scale-105 hover:border-amber-400 transition-all duration-300 cursor-pointer relative overflow-hidden group"
        style="animation-delay: {{ $index * 0.1 }}s; filter: sepia(30%);"
    >
        <!-- Фото игрока или заглушка -->
        <div class="w-full h-36 flex items-center justify-center overflow-hidden bg-white">
            @if($player->photo_path)
                <img src="{{ asset('storage/' . $player->photo_path) }}" alt="{{ $player->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @else
                <div class="text-5xl text-zinc-300">👤</div>
            @endif
        </div>

        <!-- Имя игрока -->
        <div class="p-3 flex flex-col items-center h-20 justify-center">
            <a href="{{ route('players.show', $player->id) }}" class="text-sm font-medium text-zinc-700 text-center hover:text-amber-700 line-clamp-2 leading-tight transition-colors">
                {{ $player->name }}
            </a>
        </div>

        <!-- Панель действий (появляется при наведении) -->
        @can('update', [$player])
        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white text-xs flex justify-around py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-8 group-hover:translate-y-0">
            <a href="{{ route('players.edit', $player->id) }}" class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded transition">✏️</a>
            <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded transition" onclick="return confirm('Удалить игрока {{ $player->name }}?')">
                    🗑️
                </button>
            </form>
        </div>
        @endcan
    </div>
    @endforeach
</div>