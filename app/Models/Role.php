<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Поля, которые можно массово присваивать
    protected $fillable = ['name', 'category'];

    // Связь "многие ко многим" с игроками через игры
    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player_role')->withPivot('game_id', 'score')->withTimestamps();
    }
}
