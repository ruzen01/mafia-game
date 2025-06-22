@extends('layouts.app') <!-- Указываем, какой layout использовать -->

@section('title', 'Контакты - MAFIA-VDK') <!-- Заголовок страницы -->
@section('og:title', 'Контакты - MAFIA-VDK') <!-- Open Graph заголовок -->
@section('og:description', 'Свяжитесь с нами через WhatsApp, Telegram, Instagram или по телефону.') <!-- Open Graph описание -->
@section('og:image', asset('images/logo.png')) <!-- Open Graph изображение -->

@section('content') <!-- Секция для основного контента -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Контакты</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Свяжитесь с нами</h2>
        <ul class="space-y-4">
            <li>
                <strong>WhatsApp:</strong>
                <a href="https://wa.me/your-whatsapp-group-link" class="text-blue-500 hover:text-blue-700">Присоединиться к группе WhatsApp</a>
            </li>
            <li>
                <strong>Telegram:</strong>
                <a href="https://t.me/your-telegram-group-link" class="text-blue-500 hover:text-blue-700">Присоединиться к группе Telegram</a>
            </li>
            <li>
                <strong>Instagram:</strong>
                <a href="https://instagram.com/your-instagram-profile" class="text-blue-500 hover:text-blue-700">Наш Instagram</a>
            </li>
            <li>
                <strong>Телефон:</strong>
                <a href="tel:+1234567890" class="text-blue-500 hover:text-blue-700">+1 (234) 567-890</a>
            </li>
        </ul>
    </div>
</div>
@endsection