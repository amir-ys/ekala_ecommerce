<?php

namespace Modules\Attribute\Providers;

use Illuminate\Support\ServiceProvider;

class AttributeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

    }

    public function boot()
    {

    }

}
