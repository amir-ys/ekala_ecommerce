<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Repositories\CategoryRepo;

class BlogServiceProvider extends ServiceProvider
{
    protected string $namespace = "Modules\\Blog\\Http\\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        $this->loadTranslationsFrom(__DIR__ . "/../Resources/Lang", 'Blog');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Blog');
        $this->loadRoutes();

    }

    public function boot()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware(['web' , 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/blog_routes.php");
    }

}
