<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'date', 
        'game_number', 
        'host_name', 
        'winner', 
        'season'
    ];

    // Приведение полей к нужным типам
    protected $casts = [
        'date' => 'date', // или 'datetime' — зависит от формата в БД
    ];

    // Связь многие ко многим с игроками
    public function players()
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot(
                        'role_id', 
                        'score', 
                        'best_player', 
                        'first_victim', 
                        'leader_score', 
                        'additional_score', 
                        'comment'
                    )
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'game_player', 'game_id', 'role_id');
    }
}