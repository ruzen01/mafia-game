@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать игрока</h1>
    <form action="{{ route('players.update', $player) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name">Имя игрока</label>
            <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3" value="{{ $player->name }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Сохранить</button>
    </form>
</div>
@endsection