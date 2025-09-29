@extends('layouts.app')

@section('title', 'MAFIA-VDK Welcome')

@push('styles')
<style>
    .mafia-bg {
        background-image: url('{{ asset('images/fon.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
        width: 100%;
        min-height: 100vh;
    }

    .mafia-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }

    .mafia-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
</style>
@endpush

@section('content')
<div class="mafia-bg">
    <div class="mafia-content">
        <h1 class="text-3xl md:text-4xl font-bold drop-shadow-lg">
            Добро пожаловать в мир городской мафии
        </h1>
        <p class="italic mt-2 text-lg md:text-xl drop-shadow">
            где каждый ход может стать последним...
        </p>

        <div class="mt-8 space-y-4 text-xl font-medium">
            <p>Правила</p>
            <p>Роли</p>
        </div>
    </div>
</div>
@endsection