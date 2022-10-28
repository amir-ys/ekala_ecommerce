<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Modules\Comment\Contracts\CommentRepositoryInterface;

class DashboardServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\Dashboard\Http\Controllers';

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');


    }

    public function boot()
    {
        $this->loadRoutes();
        $this->unseenCommentViewComposer();

    }

    public function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/dashboards_routes.php');
        }
    }

    public function unseenCommentViewComposer()
    {
        view()->composer('Dashboard::layouts.top-sidebar', function (View $view) {
            $unseenComments = (resolve(CommentRepositoryInterface::class))->getUnseenComments();
            return $view->with('unseenComments', $unseenComments);
        });
    }
}
