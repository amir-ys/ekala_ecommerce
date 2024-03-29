<?php

namespace Modules\Front\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Front\Http\Middleware\FillingCart;
use Modules\Front\Http\Middleware\ProfileComplete;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Models\Setting;

class FrontServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\Front\Http\Controllers";

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Front');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        app()->make('router')->aliasMiddleware('filling_cart', FillingCart::class);
        app()->make('router')->aliasMiddleware('profile_complete', ProfileComplete::class);

    }

    public function boot()
    {
        $this->loadRoutes();
        $this->footerViewComposer();
        $this->BlogCategoriesViewComposer();
        $this->ShopCategoriesViewComposer();

    }

    public function footerViewComposer()
    {
        view()->composer('Front::layouts.footer', function (View $view) {
            $settingRepo = resolve(SettingRepositoryInterface::class);

            $categories = Cache::remember('categories', now()->addDay(), function () {
                return resolve(CategoryRepositoryInterface::class)->allParentLimit(7);
            });

            $shopFooter = Cache::remember('shopFooter', now()->addDay(), function () use ($settingRepo) {
                return $settingRepo->getItem(Setting::SETTING_SHOP_FOOTER);
            });

            $shopFooterContact = Cache::remember('shopFooterContact', now()->addDay(), function () use ($settingRepo) {
                return $settingRepo->getItem(Setting::SETTING_SHOP_FOOTER_CONTACT);
            });

            $socialMedia = Cache::remember('socialMedia', now()->addDay(), function () use ($settingRepo) {
                return $settingRepo->getItem(Setting::SETTING_SOCIAL_MEDIA);
            });

            return $view->with([
                'categories' => $categories,
                'shopFooter' => $shopFooter,
                'shopFooterContact' => $shopFooterContact,
                'socialMedia' => $socialMedia,
            ]);
        });

    }

    public function BlogCategoriesViewComposer()
    {
        view()->composer('Front::layouts.main-navbar', function (View $view) {
            $categories = Cache::remember('postCategories', now()->addDay(), function () {
                return resolve(\Modules\Blog\Contracts\CategoryRepositoryInterface::class)->getAll();
            });

            return $view->with([
                'postCategories' => $categories,
            ]);
        });

    }

    public function ShopCategoriesViewComposer(): void
    {
        view()->composer('Front::layouts.main-navbar', function (View $view) {

            $categories = Cache::remember('categories', now()->addDay(), function () {
                return resolve(CategoryRepositoryInterface::class)->allParent();
            });

            return $view->with([
                'categories' => $categories,
            ]);
        });
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/front_routes.php');
        }
    }
}
