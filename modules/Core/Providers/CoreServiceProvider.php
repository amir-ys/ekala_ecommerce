<?php
namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/core.php'  ,'core');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Core');

    }

    public function boot()
    {

    }

}
