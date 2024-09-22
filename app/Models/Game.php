<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Game extends Model
{
    protected $fillable = ['name', 'date', 'game_number', 'host_id', 'result']; // Добавили 'name'

    protected $dates = ['date'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player')
                    ->withPivot('role', 'total_points', 'additional_points', 'best_player', 'first_victim', 'from_host_points', 'comment', 'custom_name') // Добавлено поле 'custom_name'
                    ->withTimestamps();
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
