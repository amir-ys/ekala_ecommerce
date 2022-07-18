<?php
namespace Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\Contracts\CityRepositoryInterface;
use Modules\User\Contracts\ProvinceRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Repositories\CityRepo;
use Modules\User\Repositories\ProvinceRepo;
use Modules\User\Repositories\UserRepo;

class UserServiceProvider extends ServiceProvider
{
    private  string $namespace = "Modules\User\Http\Controllers";
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'User');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang'  , 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/fa.json');
        $this->loadUserRoute();
        $this->loadAuthRoute();

    }

    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class , UserRepo::class);
        $this->app->bind(ProvinceRepositoryInterface::class , ProvinceRepo::class);
        $this->app->bind(CityRepositoryInterface::class , CityRepo::class);
    }

    private function loadUserRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/users_routes.php');
    }

    private function loadAuthRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/auth_routes.php');
    }
}
