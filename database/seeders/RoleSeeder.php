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
            ['name' => 'Актёр', 'category' => 'Мирный житель'],
            ['name' => 'Бессмертный', 'category' => 'Мирный житель'],
            ['name' => 'Брокер', 'category' => 'Мирный житель'],
            ['name' => 'Взломщик', 'category' => 'Мирный житель'],
            ['name' => 'Вор', 'category' => 'Мирный житель'],
            ['name' => 'Депутат', 'category' => 'Мирный житель'],
            ['name' => 'Диктатор', 'category' => 'Третья сторона'],
            ['name' => 'Доктор', 'category' => 'Мирный житель'],
            ['name' => 'Дон', 'category' => 'Мафия'],
            ['name' => 'Киллер', 'category' => 'Мафия'],
            ['name' => 'Клоун', 'category' => 'Третья сторона'],
            ['name' => 'Комиссар', 'category' => 'Мирный житель'],
            ['name' => 'Купидон', 'category' => 'Третья сторона'],
            ['name' => 'Лузер', 'category' => 'Мирный житель'],
            ['name' => 'Маньяк', 'category' => 'Третья сторона'],
            ['name' => 'Марв', 'category' => 'Мирный житель'],
            ['name' => 'Математик', 'category' => 'Мирный житель'],
            ['name' => 'Мафия', 'category' => 'Мафия'],
            ['name' => 'Мирный житель', 'category' => 'Мирный житель'],
            ['name' => 'Мэр', 'category' => 'Мафия'],
            ['name' => 'Наследник', 'category' => 'Мирный житель'],
            ['name' => 'Оборотень', 'category' => 'Мафия'],
            ['name' => 'Оператор', 'category' => 'Мирный житель'],
            ['name' => 'Офисный клерк', 'category' => 'Мирный житель'],
            ['name' => 'Папарацци', 'category' => 'Мирный житель'],
            ['name' => 'Приговоренный №1', 'category' => 'Мирный житель'],
            ['name' => 'Приговоренный №2', 'category' => 'Мафия'],
            ['name' => 'Провокатор', 'category' => 'Третья сторона'],
            ['name' => 'Психолог', 'category' => 'Мирный житель'],
            ['name' => 'Реаниматор', 'category' => 'Мирный житель'],
            ['name' => 'Робин Гуд', 'category' => 'Мирный житель'],
            ['name' => 'Свидетель', 'category' => 'Мирный житель'],
            ['name' => 'Слёзный', 'category' => 'Мирный житель'],
            ['name' => 'Стажер', 'category' => 'Мирный житель'],
            ['name' => 'Учитель', 'category' => 'Мирный житель'],
            ['name' => 'Хакер', 'category' => 'Мафия'],
            ['name' => 'Химик', 'category' => 'Мирный житель'],
            ['name' => 'Часовщик', 'category' => 'Мирный житель'],
            ['name' => 'Шаман', 'category' => 'Мирный житель'],
            ['name' => 'Шулер', 'category' => 'Мирный житель'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
