<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_player')
                    ->withPivot('role', 'total_points', 'additional_points', 'best_player', 'first_victim', 'from_host_points', 'comment')
                    ->withTimestamps();
    }

    public function hostedGames()
    {
        return $this->hasMany(Game::class, 'host_id');
    }

    public function calculateRating()
    {
        $games = $this->games;
        $totalRating = 0;

        foreach ($games as $game) {
            $pivot = $game->pivot;
            $gamePoints = $pivot->total_points + $pivot->additional_points + $pivot->from_host_points;

            if ($pivot->best_player) {
                $gamePoints += 10; // Очки за лучшего игрока
            }

            if ($pivot->first_victim) {
                $gamePoints -= 5; // Вычитание очков за первую жертву
            }

            $totalRating += $gamePoints;
        }

        return $totalRating;
    }
}