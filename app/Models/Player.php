<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name'];

    // Связь многие ко многим с моделью Game с дополнительными полями
    public function games()
    {
        return $this->belongsToMany(Game::class)
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment')
                    ->withTimestamps();
    }

    // Связь с ролью через промежуточную таблицу game_player
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'game_player')->withTimestamps();
    }
}