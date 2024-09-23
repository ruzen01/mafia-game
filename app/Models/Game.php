<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'date', 'game_number', 'host_name', 'winner'];

    // Связь многие ко многим с моделью Player
    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot('score')->withTimestamps();
    }
}
