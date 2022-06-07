<?php

namespace Modules\Front\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Modules\Category\Contracts\CategoryRepositoryInterface;

class FrontServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\Front\Http\Controllers";
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Front');
        $this->loadRoutes();
    }

    public function boot()
    {
        view()->composer('Front::layouts.main-navbar' , function (View $view){
            $categories = resolve(CategoryRepositoryInterface::class)->allParent();
            return  $view->with(['categories' => $categories ]);
        });

    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/front_routes.php');
    }
}
