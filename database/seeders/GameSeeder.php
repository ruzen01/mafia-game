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
            $bestPlayerAssigned = false; // флаг для лучшего игрока
            $firstVictimAssigned = false; // флаг для первой жертвы
            $additionalScoreAssigned = 0; // счётчик для доп. баллов

            foreach ($gamePlayers as $player) {
                // Присваиваем лучшего игрока
                $bestPlayer = 0;
                if (!$bestPlayerAssigned) {
                    $bestPlayer = 1;
                    $bestPlayerAssigned = true; // После присвоения флаг становится true
                }

                // Присваиваем первую жертву
                $firstVictim = 0;
                if (!$firstVictimAssigned) {
                    $firstVictim = 1;
                    $firstVictimAssigned = true; // После присвоения флаг становится true
                }

                // Присваиваем доп. баллы максимум двум игрокам
                $additionalScore = 0;
                if ($additionalScoreAssigned < 2) {
                    $additionalScore = rand(1, 10); // Присваиваем случайные баллы от 1 до 10
                    $additionalScoreAssigned++; // Увеличиваем счётчик игроков с доп. баллами
                }

                // Присваиваем данные игроку
                $game->players()->attach($player->id, [
                    'role_id' => rand(1, 5), // Случайная роль (1-5)
                    'score' => rand(0, 100), // Случайный результат (0-100)
                    'best_player' => $bestPlayer, // Один лучший игрок
                    'first_victim' => $firstVictim, // Одна первая жертва
                    'leader_score' => rand(0, 10), // Очки лидера (0-10)
                    'additional_score' => $additionalScore, // Дополнительные очки только двум игрокам
                    'comment' => $faker->sentence, // Случайный комментарий
                ]);
            }
        }
    }
}
