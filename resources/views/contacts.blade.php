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
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.047 24l6.305-1.654a11.882 11.882 0 005.693 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.45 5.021 11.833 11.833 0 008.569 1.525z"/>
                            </svg>
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
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.372 8.305c.124.056.166.149.111.259l-1.589 6.357c-.149.595-.471.843-1.016.545l-3.393-2.545-1.589 1.515c-.149.149-.347.223-.546.149l-.52-.223c-.669-.297-.966-.893-.594-1.515l2.39-3.824c.149-.248.074-.446-.173-.496l-4.064-.993c-.595-.149-.768-.496-.396-.868l.124-.124c.347-.347 2.615-2.341 2.937-2.59.248-.198.546-.173.744.075l1.737 2.619 3.467-2.47c.52-.372 1.04-.224 1.213.174z"/>
                            </svg>
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
                            <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.297.012 7.048.068 5.799.124 4.963.276 4.268.546c-.73.284-1.34.653-1.885 1.198C1.838 2.29 1.47 2.9 1.185 3.63.915 4.325.763 5.16.707 6.41.012 7.66 0 8.102 0 12s.012 4.34.068 5.589c.056 1.25.208 2.085.478 2.78.284.73.653 1.34 1.198 1.885.546.546 1.156.914 1.885 1.198.695.27 1.53.422 2.78.478 1.25.056 1.692.068 5.589.068s4.34-.012 5.589-.068c1.25-.056 2.085-.208 2.78-.478.73-.284 1.34-.653 1.885-1.198.546-.546.914-1.156 1.198-1.885.27-.695.422-1.53.478-2.78.056-1.25.068-1.692.068-5.589s-.012-4.34-.068-5.589c-.056-1.25-.208-2.085-.478-2.78-.284-.73-.653-1.34-1.198-1.885C21.34 1.838 20.73 1.47 19.999 1.185c-.696-.27-1.53-.422-2.78-.478C15.97.012 15.527 0 12 0zm0 1.692c3.473 0 3.877.016 5.243.07 1.322.053 2.032.27 2.575.813.544.544.76 1.254.813 2.576.054 1.366.07 1.77.07 5.243s-.016 3.877-.07 5.243c-.053 1.322-.27 2.032-.813 2.575-.544.544-1.254.76-2.576.813-1.366.054-1.77.07-5.243.07s-3.877-.016-5.243-.07c-1.322-.053-2.032-.27-2.575-.813-.544-.544-.76-1.254-.813-2.576-.054-1.366-.07-1.77-.07-5.243s.016-3.877.07-5.243c.053-1.322.27-2.032.813-2.575.544-.544 1.254-.76 2.576-.813 1.366-.054 1.77-.07 5.243-.07zm0 3.385a5.923 5.923 0 100 11.846 5.923 5.923 0 000-11.846zm0 9.79a3.874 3.874 0 110-7.747 3.874 3.874 0 010 7.747zm6.443-10.768a1.365 1.365 0 100-2.73 1.365 1.365 0 000 2.73z"/>
                            </svg>
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
                            <svg class="w-6 h-6 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.6 16.6L2 21.2V3.5C2 2.7 2.7 2 3.5 2H20.2C21 2 21.7 2.7 21.7 3.5V17.2C21.7 18 21 18.7 20.2 18.7H7.5L6.6 16.6ZM19.7 4H4V17.5L6.2 15.3C6.6 14.9 7.2 14.9 7.6 15.3L9.5 17.2C9.9 17.6 9.9 18.2 9.5 18.6L7.6 20.5H19.7V4ZM12.5 6.5C11.1 6.5 10 7.6 10 9C10 10.4 11.1 11.5 12.5 11.5C13.9 11.5 15 10.4 15 9C15 7.6 13.9 6.5 12.5 6.5ZM12.5 9.5C12.2 9.5 12 9.3 12 9C12 8.7 12.2 8.5 12.5 8.5C12.8 8.5 13 8.7 13 9C13 9.3 12.8 9.5 12.5 9.5Z"/>
                            </svg>
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