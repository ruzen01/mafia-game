@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center text-zinc-800">Редактировать игрока</h1>

    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('players.update', $player) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-zinc-700">Имя игрока</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $player->name) }}"
                    class="mt-1 block w-full border @error('name') border-red-500 @else border-zinc-300 @endif rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Введите имя"
                    maxlength="255"
                    required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('players.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2 transition">Отмена</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded font-semibold transition">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</div>
@endsection