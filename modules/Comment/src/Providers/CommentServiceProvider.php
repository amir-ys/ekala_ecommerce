<?php
namespace Modules\Comment\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Models\Comment;
use Modules\Comment\Policies\CommentPolicy;
use Modules\Comment\Repositories\CommentRepo;

class CommentServiceProvider extends  ServiceProvider
{
    private string $namespace = 'Modules\Comment\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Comment');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Comment');
        $this->loadRoutes();
        Gate::policy(Comment::class , CommentPolicy::class);
    }

    public function boot()
    {
        $this->app->bind(CommentRepositoryInterface::class , CommentRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware(['web' , 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/comments_routes.php');
    }

}
