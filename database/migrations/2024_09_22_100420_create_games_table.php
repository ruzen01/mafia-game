<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Имя игры
            $table->date('date'); // Дата игры
            $table->integer('game_number'); // Порядковый номер игры в эту дату
            $table->string('host_name'); // Имя ведущего
            $table->enum('winner', ['Мафия', 'Мирные жители', 'Третья сторона']); // Кто победил
            $table->timestamps(); // Поля created_at и updated_at
            $table->string('season')->default('Осень-зима 2024-2025'); // Добавляем новое поле
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
