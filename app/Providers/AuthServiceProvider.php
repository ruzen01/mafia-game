<?php

namespace App\Providers;

use App\Models\Game;
use App\Models\Player;
use App\Policies\GamePolicy;
use App\Policies\PlayerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Game::class => GamePolicy::class,
        Player::class => PlayerPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
