<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider


//IMPORTANTE TOCAR


{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */


     //SIRVE PARA ASOCIAR POLICIES A LAS ENTIDADES
    protected $policies = [
        Acceso::class => AccesoPolicy::class,
        Sanitario::class => SanitarioPolicy::class,
        Cargo::class => CargoPolicy::class,
        Profesion::class => ProfesionPolicy::class,
        Incidencia::class => IncidenciaPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
