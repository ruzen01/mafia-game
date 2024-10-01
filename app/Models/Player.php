<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 

class Player extends Model 
{ 
    use HasFactory;

    protected $fillable = ['name']; 

    // Связь многие ко многим с моделью Game с дополнительными полями 
    public function games() 
    { 
        return $this->belongsToMany(Game::class)
                    ->withPivot('role_id', 'score', 'best_player', 'first_victim', 'leader_score', 'additional_score', 'comment') 
                    ->withTimestamps(); 
    } 

    // Связь с ролью через промежуточную таблицу game_player 
    public function roles() 
    { 
        return $this->belongsToMany(Role::class, 'game_player')->withTimestamps(); 
    }

    // Подсчет количества игр игрока
    public function getTotalGamesAttribute()
    {
        return $this->games()->count();
    }

    // Подсчет количества побед игрока
    public function getTotalWinsAttribute()
    {
        return $this->games()->wherePivot('leader_score', '>', 0)->count();
    }

    // Подсчет количества поражений игрока
    public function getTotalLossesAttribute()
    {
        return $this->games()->wherePivot('leader_score', '<=', 0)->count();
    }

    // Подсчет баллов за звание лучшего игрока
    public function getBestPlayerPointsAttribute()
    {
        return $this->games()->wherePivot('best_player', true)->sum('pivot.leader_score');
    }

    // Подсчет баллов за первую жертву
    public function getFirstVictimPointsAttribute()
    {
        return $this->games()->wherePivot('first_victim', true)->sum('pivot.first_victim');
    }

    // Подсчет дополнительных баллов
    public function getAdditionalPointsAttribute()
    {
        return $this->games()->sum('pivot.additional_score');
    }

    // Общий подсчет всех баллов
    public function getTotalPointsAttribute()
    {
        return $this->getBestPlayerPointsAttribute() 
             + $this->getFirstVictimPointsAttribute()
             + $this->getAdditionalPointsAttribute();
    }
}