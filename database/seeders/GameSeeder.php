<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Player;
use Faker\Factory as Faker;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Получаем всех игроков из базы данных
        $players = Player::all();

        // Создаем 20 игр
        for ($i = 0; $i < 20; $i++) {
            // Генерируем случайную дату за последний год
            $gameDate = $faker->dateTimeBetween('-1 year', 'now');

            // Выбираем случайных игроков для игры
            $gamePlayers = $players->random(rand(10, 15));

            // Выбираем случайного победителя из возможных вариантов
            $winner = $faker->randomElement(['Мафия', 'Мирные жители', 'Третья сторона']);

            // Создаем игру с корректными данными
            $game = Game::create([
                'name' => 'Game ' . ($i + 1),
                'game_number' => $i + 1, // Порядковый номер игры
                'host_name' => $faker->name, // Случайное имя ведущего игры
                'winner' => $winner, // Один из трех вариантов победителя
                'season' => $faker->randomElement(['Осень-зима 2024-2025', 'Весна-лето 2024', 'Весна-лето 2025']), // Случайный сезон
                'date' => $gameDate,
            ]);

            // Присваиваем случайные данные каждому игроку
            foreach ($gamePlayers as $player) {
                $game->players()->attach($player->id, [
                    'role_id' => rand(1, 5), // Случайная роль (1-5)
                    'score' => rand(0, 100), // Случайный результат (0-100)
                    'best_player' => rand(0, 1), // Лучшая игра (0 или 1)
                    'first_victim' => rand(0, 1), // Первый убитый (0 или 1)
                    'leader_score' => rand(0, 10), // Очки лидера (0-10)
                    'additional_score' => rand(0, 10), // Дополнительные очки (0-10)
                    'comment' => $faker->sentence, // Случайный комментарий
                ]);
            }
        }
    }
}