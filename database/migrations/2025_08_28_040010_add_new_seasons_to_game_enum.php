<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Обновляем ENUM, добавляем новые значения
        DB::statement("ALTER TABLE games MODIFY season ENUM(
            'Осень-зима 2024-2025',
            'Лето 2025',
            'Осень 2025',
            'Зима 2025',
            'Финал 2025'   -- ← добавляем новый
        ) DEFAULT 'Осень-зима 2024-2025'");
    }

    public function down()
    {
        // Возвращаем предыдущий список (без нового сезона)
        DB::statement("ALTER TABLE games MODIFY season VARCHAR(255) DEFAULT 'Осень-зима 2024-2025'");
    }
};
