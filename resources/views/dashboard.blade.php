@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-center">
    Добро пожаловать, {{ Auth::user()->name }}!
</h1>
@endsection