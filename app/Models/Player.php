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
     * Получить общие баллы игрока
     */
    public function getTotalPointsAttribute()
    {
        // Подсчет общих баллов, суммируя все поля: leader_score, score, additional_score, best_player, first_victim
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
        // Суммирование всех баллов leader_score для игрока, который был выбран как лучший игрок (best_player = 1)
        return $this->games()->wherePivot('best_player', 1)->sum('leader_score');
    }

    /**
     * Получить баллы за дополнительные достижения
     */
    public function getAdditionalPointsAttribute()
    {
        // Суммирование дополнительных баллов (additional_score) для всех игр
        return $this->games()->sum('additional_score');
    }

    /**
     * Получить баллы за первую жертву
     */
    public function getFirstVictimPointsAttribute()
    {
        // Подсчет количества раз, когда игрок был первой жертвой, умноженного на 1 (или другой весовой коэффициент, если он должен быть больше)
        return $this->games()->wherePivot('first_victim', 1)->count();
    }
}