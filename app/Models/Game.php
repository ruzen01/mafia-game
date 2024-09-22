<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'game_number',
        'host_name',  // Используем host_name вместо host_id
        'result',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player')
            ->withPivot('role', 'total_points', 'additional_points', 'best_player', 'first_victim', 'from_host_points', 'comment', 'custom_name')
            ->withTimestamps();
    }
    
    public function host()
    {
        return $this->belongsTo(Player::class, 'host_name');
    }
}
