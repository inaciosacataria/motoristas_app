<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.tailwind');

        // Partilhar contagem de notificações não lidas com a navbar (layout modern)
        View::composer('layouts.partials.navbar', function ($view) {
            $notificationCount = 0;
            if (Auth::check()) {
                try {
                    $notificationCount = app(NotificationService::class)->countUnread(Auth::id());
                } catch (\Throwable $e) {
                    // ignorar falhas (ex.: tabela não existir)
                }
            }
            $view->with('notificationCount', $notificationCount);
        });
    }
}
