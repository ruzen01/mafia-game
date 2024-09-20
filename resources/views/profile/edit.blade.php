@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold mb-4">Редактировать профиль</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-xl">Имя</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-xl">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить изменения</button>
    </form>
</div>
@endsection