@extends('layouts.app')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="flex items-center justify-center min-h-screen text-center" style="background-image: url('https://drive.google.com/uc?export=view&id=19KbX-tA2KSz3mpH5wAp_c_4WQeNvFpma'); background-size: cover; background-position: center;">
        <div>
            <h1 class="text-5xl font-bold mb-4">Погрузитесь в мир Мафии</h1>
            <p class="text-xl mb-8">Где каждый ход может стать последним</p>
            <a href="{{ route('rules') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Узнать правила</a>
        </div>
    </div>
@endsection