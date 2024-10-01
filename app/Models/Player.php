<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    // Добавьте поле 'name' в fillable
    protected $fillable = [
        'name',  
        'email', // или другие поля, если они есть
        // Добавляйте сюда другие поля, которые вы хотите разрешить для массового присвоения
    ];

    protected $table = 'players';

    /**
     * Связь с играми через промежуточную таблицу game_player
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_player')
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment')
                    ->withTimestamps();
    }

    /**
     * Получить общее количество игр игрока
     */
    public function getTotalGamesAttribute()
    {
        return $this->games()->count();
    }

    /**
     * Получить количество побед игрока
     */
    public function getTotalWinsAttribute()
    {
        // Победа определяется, если игрок набрал больше 0 баллов (измените логику по необходимости)
        return $this->games()->wherePivot('score', '>', 0)->count();
    }

    /**
     * Получить количество поражений игрока
     */
    public function getTotalLossesAttribute()
    {
        // Поражение определяется, если игрок набрал 0 или меньше баллов
        return $this->games()->wherePivot('score', '<=', 0)->count();
    }

    /**
     * Получить количество званий "Лучший игрок"
     */
    public function getBestPlayerPointsAttribute()
    {
        return $this->games()->wherePivot('best_player', 1)->count();
    }

    /**
     * Получить общие баллы игрока
     */
    public function getTotalPointsAttribute()
    {
        return $this->games()->sum('score')
             + $this->games()->wherePivot('best_player', 1)->sum('leader_score')
             + $this->games()->wherePivot('first_victim', 1)->count()
             + $this->games()->sum('additional_score');
    }

    /**
     * Получить баллы за роль лидера
     */
    public function getLeaderScorePointsAttribute()
    {
        return $this->games()->wherePivot('best_player', 1)->sum('leader_score');
    }

    /**
     * Получить баллы за дополнительные достижения
     */
    public function getAdditionalPointsAttribute()
    {
        return $this->games()->sum('additional_score');
    }

    /**
     * Получить баллы за первую жертву
     */
    public function getFirstVictimPointsAttribute()
    {
        return $this->games()->wherePivot('first_victim', 1)->count();
    }
}