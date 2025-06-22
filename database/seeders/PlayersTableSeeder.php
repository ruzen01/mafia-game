<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            'Эддард Старк',
            'Кейтилин Старк',
            'Джон Сноу',
            'Арья Старк',
            'Санса Старк',
            'Бран Старк',
            'Робб Старк',
            'Дейенерис Таргариен',
            'Тирион Ланнистер',
            'Джейме Ланнистер',
            'Серсея Ланнистер',
            'Джоффри Баратеон',
            'Станнис Баратеон',
            'Ренли Баратеон',
            'Роберт Баратеон',
            'Бриенна Тарт',
            'Сэмвелл Тарли',
            'Сандор Клиган',
            'Грегор Клиган',
            'Варис',
            'Мизинец (Петир Бейлиш)',
            'Джорах Мормонт',
            'Рамси Болтон',
            'Теон Грейджой',
            'Яра Грейджой',
            'Мелисандра',
            'Бенджен Старк',
            'Тормунд Великанья Смерть',
            'Хал Дрого',
            'Мейстер Эймон'
        ];

        foreach ($players as $name) {
            DB::table('players')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}