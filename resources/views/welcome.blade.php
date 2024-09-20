@extends('layouts.app')

@section('title', 'Добро пожаловать')

@section('bodyClass', 'text-white flex flex-col min-h-screen')

@push('styles')
<style>
    body {
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>
@endpush

@section('content')
    <div class="flex items-center justify-center flex-grow text-center">
        <div>
            <h1 class="text-5xl font-bold mb-4">Погрузитесь в мир Мафии</h1>
            <p class="text-xl mb-8">Где каждый ход может стать последним</p>
            <a href="{{ route('rules') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Узнать правила</a>
        </div>
    </div>
@endsection