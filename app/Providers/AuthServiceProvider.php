<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Incidencia' => 'App\Policies\IncidencePolicy',
        'App\Models\Zona' => 'App\Policies\ZonePolicy',
        'App\Models\Usuari' => 'App\Policies\UserPolicy',
        'App\Models\UsariarResol' => 'App\Policies\UserResolPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
