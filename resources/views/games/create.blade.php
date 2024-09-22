@extends('layouts.app')

@section('title', 'Добавить новую игру')

@section('content')

@if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif

<h1 class="text-2xl text-center mb-6">Добавить новую игру</h1>

<form action="{{ route('games.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="game_name" class="block text-gray-200 font-bold mb-2">Название игры:</label>
        <input type="text" name="name" id="game_name" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="date" class="block text-gray-200 font-bold mb-2">Дата игры:</label>
        <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="game_number" class="block text-gray-200 font-bold mb-2">Порядковый номер игры:</label>
        <input type="number" name="game_number" id="game_number" class="w-full px-4 py-2 border rounded text-gray-800" required>
    </div>
    <div class="mb-4">
        <label for="host_name" class="block text-gray-200 font-bold mb-2">Имя ведущего:</label>
        <input type="text" name="host_name" id="host_name" class="w-full px-4 py-2 border rounded text-gray-800" placeholder="Введите имя ведущего" required>
    </div>
    <div class="mb-4">
        <label for="result" class="block text-gray-200 font-bold mb-2">Результат игры:</label>
        <select name="result" id="result" class="w-full px-4 py-2 border rounded text-gray-800" required>
            <option value="Мафия">Мафия</option>
            <option value="Мирные жители">Мирные жители</option>
            <option value="Третья сторона">Третья сторона</option>
        </select>
    </div>
    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Сохранить результаты</button>
</form>

@endsection