<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name'];

    // Связь многие ко многим с моделью Game
    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot('score')->withTimestamps();
    }
}