<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name',  
        'email', 
    ];

    protected $table = 'players';

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_player')
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment')
                    ->withTimestamps();
    }

    public function getTotalGamesAttribute()
    {
        return $this->games()->count();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'game_player', 'player_id', 'role_id');
    }

    public function countWinsByCategory($category)
    {
        return $this->games()
            ->whereHas('roles', function($query) use ($category) {
                $query->where('category', $category);
            })
            ->whereHas('roles', function($query) {
                $query->whereColumn('category', 'winner');
            })
            ->count();
    }

    public function countLossesByCategory($category)
    {
        return $this->games()
            ->whereHas('roles', function($query) use ($category) {
                $query->where('category', $category);
            })
            ->whereDoesntHave('roles', function($query) {
                $query->whereColumn('category', 'winner');
            })
            ->count();
    }

    public function getTotalWinsAttribute()
    {
        return $this->countWinsByCategory('Мафия') + $this->countWinsByCategory('Мирный житель') + $this->countWinsByCategory('Третья сторона');
    }

    public function getTotalLossesAttribute()
    {
        return $this->countLossesByCategory('Мафия') + $this->countLossesByCategory('Мирный житель') + $this->countLossesByCategory('Третья сторона');
    }

    public function getBestPlayerPointsAttribute()
    {
        return $this->games()->wherePivot('best_player', 1)->count();
    }

    public function getTotalPointsAttribute()
    {
        return ($this->total_wins * 2)
             + $this->games()->sum('score')
             + $this->games()->wherePivot('best_player', 1)->sum('leader_score')
             + $this->games()->wherePivot('first_victim', 1)->count()
             + $this->games()->sum('additional_score');
    }

    public function getLeaderScorePointsAttribute()
    {
        return $this->games()->wherePivot('best_player', 1)->sum('leader_score');
    }

    public function getAdditionalPointsAttribute()
    {
        return $this->games()->sum('additional_score');
    }

    public function getFirstVictimPointsAttribute()
    {
        return $this->games()->wherePivot('first_victim', 1)->count();
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }
}