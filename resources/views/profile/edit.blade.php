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

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-xl">Имя</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-xl">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="avatar" class="block text-xl">Аватар</label>
            <input type="file" name="avatar" id="avatar" class="w-full p-2 rounded">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mt-2 w-20 h-20 rounded-full">
            @endif
        </div>

        <div class="mb-4">
            <label for="user_type" class="block text-xl">Тип пользователя</label>
            <input type="text" id="user_type" value="{{ $user->user_type }}" class="w-full p-2 rounded" readonly>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить изменения</button>
    </form>
</div>
@endsection