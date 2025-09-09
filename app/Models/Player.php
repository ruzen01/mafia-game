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
    $possibleExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $baseDir = public_path('images/players');
    $baseUrl = asset('images/players');

    foreach ($possibleExtensions as $ext) {
        $path = "{$baseDir}/{$this->id}.{$ext}";
        if (file_exists($path)) {
            return "{$baseUrl}/{$this->id}.{$ext}?v=" . filemtime($path);
        }
    }

    // fallback — если изображения нет
    return asset('images/players/placeholder.png');
}
}
