<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router)
    {
        // Registrar el middleware de 'role' de Spatie
        $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }
}
