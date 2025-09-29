@extends('layouts.app')

@section('title', 'MAFIA-VDK Welcome')

@push('styles')
<style>
    .parallax-bg {
        background-image: url('{{ asset('fon.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    .parallax-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Затемнение для контраста */
        z-index: 0;
    }

    .content-wrapper {
        position: relative;
        z-index: 1;
    }
</style>
@endpush

@section('content')
<div class="parallax-bg min-h-screen flex flex-col">
    <div class="content-wrapper flex flex-col items-center justify-center flex-grow text-center px-4">
        <!-- Заголовок -->
        <h1 class="text-3xl md:text-4xl font-bold text-white mt-8 drop-shadow-lg">
            Добро пожаловать в мир городской мафии
        </h1>
        <p class="italic text-white mt-2 text-lg md:text-xl drop-shadow">
            где каждый ход может стать последним...
        </p>

        <!-- Блок без ссылок -->
        <div class="mt-8 space-y-4 text-white text-xl font-medium">
            <p>Правила</p>
            <p>Роли</p>
        </div>
    </div>
</div>
@endsection