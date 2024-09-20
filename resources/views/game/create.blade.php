@extends('layouts.app')

@section('title', 'Начать новую игру')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold mb-4">Новая игра</h1>
    <form action="{{ route('game.store') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Начать игру</button>
    </form>
</div>
@endsection