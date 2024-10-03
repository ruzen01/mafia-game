<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'email'];

    protected $table = 'players';

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_player')
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'game_player', 'player_id', 'role_id');
    }

    public function getTotalGamesAttribute()
    {
        return $this->games()->count();
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }
}
