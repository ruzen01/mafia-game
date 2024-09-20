<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['date', 'game_number', 'host_id', 'result'];

    protected $dates = ['date'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player')
                    ->withPivot('role', 'total_points', 'additional_points', 'best_player', 'first_victim', 'from_host_points', 'comment')
                    ->withTimestamps();
    }

    public function host()
    {
        return $this->belongsTo(Player::class, 'host_id');
    }
}