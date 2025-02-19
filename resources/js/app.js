import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Импорт основного модуля Swiper
import Swiper from 'swiper';

// Импорт необходимых модулей (Navigation и Pagination)
import { Navigation, Pagination } from 'swiper/modules';

// Импорт CSS для Swiper
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Подключение модулей к Swiper
Swiper.use([Navigation, Pagination]);

// Инициализация Swiper
document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.mySwiper', {
        slidesPerView: 1, // Количество слайдов на экране
        spaceBetween: 20, // Пробел между слайдами
        loop: true, // Бесконечный цикл
        navigation: {
            nextEl: '.swiper-button-next', // Селектор кнопки "вперед"
            prevEl: '.swiper-button-prev', // Селектор кнопки "назад"
        },
        pagination: {
            el: '.swiper-pagination', // Селектор пагинации
            clickable: true, // Пагинация кликабельна
        },
    });
});