<?php
namespace Modules\AttributeGroup\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Repositories\AttributeGroupRepo;

class AttributeGroupServiceProvider extends  ServiceProvider
{
    private string $namespace = 'Modules\AttributeGroup\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'AttributeGroup');
        $this->loadRoutes();

    }

    public function boot()
    {
        app()->bind(AttributeGroupRepositoryInterface::class , AttributeGroupRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/attributeGroups_routes.php');
    }

}
