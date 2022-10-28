<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Blog\Models\Post;
use Modules\Blog\Policies\BlogPolicy;
use Modules\Blog\Repositories\CategoryRepo;
use Modules\Blog\Repositories\PostRepo;

class BlogServiceProvider extends ServiceProvider
{
    protected string $namespace = "Modules\\Blog\\Http\\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        $this->loadTranslationsFrom(__DIR__ . "/../Resources/Lang", 'Blog');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Blog');
        Gate::policy(Post::class, BlogPolicy::class);
    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepo::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepo::class);
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . "/../Routes/blog_routes.php");
        }
    }

}
