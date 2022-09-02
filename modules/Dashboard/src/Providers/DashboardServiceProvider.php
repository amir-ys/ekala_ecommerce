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
        $this->loadRoutes();


    }

    public function boot()
    {
        $this->unseenCommentViewComposer();

    }

    public function loadRoutes()
    {
        Route::middleware(['web' , 'auth' , 'verified'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/dashboards_routes.php');
    }

    public function unseenCommentViewComposer()
    {
        view()->composer('Dashboard::layouts.top-sidebar' , function (View $view){
            $unseenComments = (resolve(CommentRepositoryInterface::class))->getUnseenComments();
           return $view->with('unseenComments' , $unseenComments);
        });
    }
}
