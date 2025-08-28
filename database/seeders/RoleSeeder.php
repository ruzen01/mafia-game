<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['name' => 'Адвокат', 'category' => 'Мафия'],
            ['name' => 'Актёр', 'category' => 'Мирные жители'],
            ['name' => 'Бессмертный', 'category' => 'Мирные жители'],
            ['name' => 'Брокер', 'category' => 'Мирные жители'],
            ['name' => 'Взломщик', 'category' => 'Мирные жители'],
            ['name' => 'Вор', 'category' => 'Мирные жители'],
            ['name' => 'Депутат', 'category' => 'Мирные жители'],
            ['name' => 'Диктатор', 'category' => 'Третья сторона'],
            ['name' => 'Доктор', 'category' => 'Мирные жители'],
            ['name' => 'Дон', 'category' => 'Мафия'],
            ['name' => 'Киллер', 'category' => 'Мафия'],
            ['name' => 'Клоун', 'category' => 'Третья сторона'],
            ['name' => 'Комиссар', 'category' => 'Мирные жители'],
            ['name' => 'Купидон', 'category' => 'Третья сторона'],
            ['name' => 'Лузер', 'category' => 'Мирные жители'],
            ['name' => 'Маньяк', 'category' => 'Третья сторона'],
            ['name' => 'Марв', 'category' => 'Мирные жители'],
            ['name' => 'Математик', 'category' => 'Мирные жители'],
            ['name' => 'Мафия', 'category' => 'Мафия'],
            ['name' => 'Мирный житель', 'category' => 'Мирные жители'],
            ['name' => 'Мэр', 'category' => 'Мафия'],
            ['name' => 'Наследник', 'category' => 'Мирные жители'],
            ['name' => 'Оборотень', 'category' => 'Мафия'],
            ['name' => 'Оператор', 'category' => 'Мирные жители'],
            ['name' => 'Офисный клерк', 'category' => 'Мирные жители'],
            ['name' => 'Папарацци', 'category' => 'Мирные жители'],
            ['name' => 'Приговоренный №1', 'category' => 'Мирные жители'],
            ['name' => 'Приговоренный №2', 'category' => 'Мафия'],
            ['name' => 'Провокатор', 'category' => 'Третья сторона'],
            ['name' => 'Психолог', 'category' => 'Мирные жители'],
            ['name' => 'Реаниматор', 'category' => 'Мирные жители'],
            ['name' => 'Робин Гуд', 'category' => 'Мирные жители'],
            ['name' => 'Свидетель', 'category' => 'Мирные жители'],
            ['name' => 'Слёзный', 'category' => 'Мирные жители'],
            ['name' => 'Стажер', 'category' => 'Мирные жители'],
            ['name' => 'Учитель', 'category' => 'Мирные жители'],
            ['name' => 'Хакер', 'category' => 'Мафия'],
            ['name' => 'Химик', 'category' => 'Мирные жители'],
            ['name' => 'Часовщик', 'category' => 'Мирные жители'],
            ['name' => 'Шаман', 'category' => 'Мирные жители'],
            ['name' => 'Шулер', 'category' => 'Мирные жители'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
