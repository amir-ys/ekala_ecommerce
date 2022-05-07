<?php
namespace Modules\AttributeGroup\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AttributeGroupServiceProvider extends  ServiceProvider
{
    private string $namespace = 'Modules\AttributeGroup\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutes();

    }

    public function boot()
    {

    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/attributeGroups_routes.php');
    }

}
