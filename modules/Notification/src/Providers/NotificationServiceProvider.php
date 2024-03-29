<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Notification\Facades\NotificationFacade;
use Modules\Notification\Services\Notification;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/notification.php', 'notification');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Notification');
    }

    public function boot()
    {
        NotificationFacade::run(Notification::class);
    }
}
