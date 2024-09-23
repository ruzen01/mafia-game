<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'date', 'game_number', 'host_name', 'winner'];

    // Связь многие ко многим с моделью Player с дополнительными полями
    public function players()
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment')
                    ->withTimestamps();
    }
}
