<?php
namespace Modules\Slide\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Slide\Contracts\SlideRepositoryInterface;
use Modules\Slide\Models\Slide;
use Modules\Slide\Policies\SlidePolicy;
use Modules\Slide\Repositories\SlideRepo;

class SlideServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Slide\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Slide');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Slide');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadRoutes();
        Gate::policy(Slide::class , SlidePolicy::class);
    }

    public function boot()
    {
        $this->app->bind(SlideRepositoryInterface::class , SlideRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware(['web' , 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/slides_routes.php');
    }

}
