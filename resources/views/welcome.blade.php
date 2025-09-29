@extends('layouts.app')

@section('title', 'MAFIA-VDK Welcome')

@section('content')
<style>
    .bg-mafia {
        background-image: url('{{ asset('images/fon.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .bg-mafia::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }
    .bg-mafia > * {
        position: relative;
        z-index: 1;
        color: white;
        text-align: center;
    }
</style>

<div class="bg-mafia">
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
@endsection