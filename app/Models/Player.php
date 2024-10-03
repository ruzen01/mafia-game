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

    // Связь с ролями
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'game_player', 'player_id', 'role_id');
    }

    // Метод для подсчета количества побед по категориям ролей
    public function countWinsByCategory($category)
    {
        return $this->games()
            ->whereHas('roles', function($query) use ($category) {
                $query->where('category', $category);  // Условие по категории
            })
            ->where('winner', $this->roles->first()->category)  // Победившая категория должна совпадать
            ->count();
    }

    // Метод для подсчета количества поражений по категориям ролей
    public function countLossesByCategory($category)
    {
        return $this->games()
            ->whereHas('roles', function($query) use ($category) {
                $query->where('category', $category);
            })
            ->where('winner', '!=', $this->roles->first()->category)  // Победившая категория не должна совпадать
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

    public function getAvatarUrlAttribute()
{
    return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
}
}