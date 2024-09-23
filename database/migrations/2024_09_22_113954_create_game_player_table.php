<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Убедитесь, что столбец role_id присутствует
            $table->integer('score')->default(0);
            $table->boolean('best_player')->default(false); // галочка "балл за лучшего игрока"
            $table->boolean('first_victim')->default(false); // галочка "балл за первую жертву"
            $table->integer('leader_score')->default(0); // балл от ведущего
            $table->boolean('additional_score')->default(0);
            $table->text('comment')->nullable(); // комментарий
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_player');
    }
};
