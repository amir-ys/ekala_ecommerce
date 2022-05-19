<?php

namespace Modules\Attribute\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Repositories\AttributeRepo;

class AttributeServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Attribute\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Attribute');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang' , 'Attribute');
        $this->loadRoutes();

    }

    public function boot()
    {
        $this->app->bind(AttributeRepositoryInterface::class , AttributeRepo::class);

    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/attributes_routes.php');
    }

}
