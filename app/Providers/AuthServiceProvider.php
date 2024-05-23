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
        'App\Models\Incidencia' => 'App\Policies\checkRole',
        'App\Models\Zona' => 'App\Policies\checkRole',
        'App\Models\Usuari' => 'App\Policies\checkRole',
        'App\Models\UsariarResol' => 'App\Policies\checkRole',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
