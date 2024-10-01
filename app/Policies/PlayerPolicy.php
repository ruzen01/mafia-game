<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Player;

class PlayerPolicy
{
    /**
     * Определите, может ли пользователь создавать игроков.
     */
    public function create(User $user)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Определите, может ли пользователь обновлять игрока.
     */
    public function update(User $user, Player $player)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Определите, может ли пользователь удалять игрока.
     */
    public function delete(User $user, Player $player)
    {
        return $user->user_type === 'admin';
    }
}