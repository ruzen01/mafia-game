@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создать игрока</h1>
    <form action="{{ route('players.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium">Имя игрока:</label>
        <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3">
    </div>

    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Создать игрока</button>
</form>
</div>
@endsection