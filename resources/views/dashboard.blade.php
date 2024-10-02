@extends('layouts.app')

<h1 class="text-2xl font-semibold text-gray-900">
    Добро пожаловать, {{ Auth::user()->name }}!
</h1>