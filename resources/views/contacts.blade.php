@extends('layouts.app')

@section('title', 'Контакты - MAFIA-VDK')
@section('og:title', 'Контакты - MAFIA-VDK')
@section('og:description', 'Свяжитесь с нами через WhatsApp, Telegram, Instagram или по телефону.')
@section('og:image', asset('images/logo.png'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl sm:text-4xl font-extrabold mb-8 text-center text-zinc-800">Связаться с нами</h1>
    
    <div class="max-w-2xl mx-auto">
        <div class="bg-zinc-800 rounded-xl shadow-xl overflow-hidden">
            <!-- Заголовок карточки -->
            <div class="bg-zinc-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Присоединяйтесь к нам</h2>
                <p class="text-zinc-300 text-sm">Выберите удобный способ связи</p>
            </div>
            
            <!-- Список контактов -->
            <div class="p-6 space-y-4">
                <!-- WhatsApp -->
                <a href="https://chat.whatsapp.com/KjCXlZBq7SW9wUGJuf4uWj?mode=ac_t" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="block bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white">WhatsApp группа</div>
                            <div class="text-green-100 text-sm">Присоединяйтесь к нашему чату</div>
                        </div>
                        <svg class="w-5 h-5 text-green-200 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <!-- Telegram -->
                <a href="https://t.me/+VJenl1cVWc6t1mjE" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="block bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fab fa-telegram-plane text-blue-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white">Telegram группа</div>
                            <div class="text-blue-100 text-sm">Наш канал в Telegram</div>
                        </div>
                        <svg class="w-5 h-5 text-blue-200 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/mafia_vdk?igsh=MXZtaWFrZW1iN3R4eA==" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="block bg-gradient-to-r from-pink-500 to-yellow-500 hover:from-pink-600 hover:to-yellow-600 text-white p-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fab fa-instagram text-pink-500 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white">Instagram</div>
                            <div class="text-pink-100 text-sm">Следите за нашими новостями</div>
                        </div>
                        <svg class="w-5 h-5 text-white ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <!-- Телефон -->
                <a href="tel:+79025058256" 
                   class="block bg-zinc-600 hover:bg-zinc-700 text-white p-4 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-zinc-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white">Телефон</div>
                            <div class="text-zinc-300 text-sm">+7 (902) 505-82-56</div>
                        </div>
                        <svg class="w-5 h-5 text-zinc-300 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!-- Дополнительная информация -->
        <div class="mt-8 text-center">
            <p class="text-zinc-600 text-sm">
                Наши администраторы ответят на все ваши вопросы и помогут присоединиться к игре!
            </p>
        </div>
    </div>
</div>
@endsection