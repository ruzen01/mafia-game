<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Здесь вы можете привязать свои модели к их политикам
        \App\Models\Game::class => \App\Policies\GamePolicy::class,
        \App\Models\Player::class => \App\Policies\PlayerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Вы можете добавить дополнительные правила авторизации через Gate здесь
        Gate::define('access-dashboard', function ($user) {
            return $user->hasRole('admin');
        });
    }
}