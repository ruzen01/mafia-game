<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Game;

class GamePolicy
{
    /**
     * Определите, может ли пользователь создавать игры.
     */
    public function create(User $user)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Определите, может ли пользователь обновлять игру.
     */
    public function update(User $user, Game $game = null)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Определите, может ли пользователь удалять игру.
     */
    public function delete(User $user, Game $game)
    {
        return $user->user_type === 'admin';
    }
}
